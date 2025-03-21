<?php

 
namespace App\Services\Page;

 
use App\Models\Page;
use App\Models\PageLangs;
use Illuminate\Support\Facades\DB;

class Service
{
    public function store($data){
         
        try{
                DB::beginTransaction();
              
                if(isset($data["publish"])){
                    $data["publish"] == true ? $data["publish"] = 1: $data["publish"] = 0;
                }
                $page = Page::firstOrCreate(['slug' => $data['slug']] , 
                ['slug' => $data['slug'], 'publish' => $data['publish'], 'template' => 'txtpage']); 
                 
               /* if(isset($data['title'])){
                    PageLangs::firstOrCreate(['page_id' => $page->id, 'title' => $data['title']],
                ['title' => $data['title'], 'content' => $data['content']]
                    );
                }*/ 
                 
                DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
           return $e->getMessage();
        }
        return $page;
           
    }
    public function update($page, $data){
        
               dd($data);
                $page->update($data);
                
            
                return $page;
    }

  


    
}
