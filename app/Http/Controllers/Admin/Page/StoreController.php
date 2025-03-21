<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Page\StoreRequest;
use App\Http\Resources\Page\PageResource;
use App\Models\Page;
use App\Models\PageLangs;
use App\Models\PageMeta;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request){
        $data =  $request->validated(); 

       // $page = $this->service->store($data);

        
        // create page

        if(isset($data["publish"])){
            $data["publish"] == true ? $data["publish"] = 1: $data["publish"] = 0;
        }
            $page = Page::firstOrCreate(['slug' => $data['slug']] , 
        ['slug' => $data['slug'], 'publish' => $data['publish'], 'template' => $data['template']]); 


        // for langs data

        if(isset($data['title'])){
            PageLangs::firstOrCreate(['page_id' => $page->id, 'title' => $data['title']],
        ['title' => $data['title'], 'content' => $data['content'], 'lang' => 'ru']
            );
        }

        // for meta data

        if(isset($data['metas'])){
            foreach($data['metas'] as $key => $elem){
                
               PageMeta::firstOrCreate(['page_id' => $page->id, 'name' => $key],
               ['name' => $key, 'content' => $elem, 'lang' => 'ru'] 
            ); 
          

            }
             
        }
        return $page;
        //return redirect()->route("admin.page.index");
        //return new PageResource($page);
    }
}
