<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Page\StoreRequest;
use App\Http\Resources\Page\PageResource;
use App\Models\Page;
use App\Models\PageLangs;
use App\Models\PageMeta;
use Illuminate\Support\Facades\Storage;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request){
        $data =  $request->validated(); 

       // $page = $this->service->store($data);

       $languages = ['ru','en','fr'];
        // create page

        if(isset($data["publish"])){
            $data["publish"] == true ? $data["publish"] = 1: $data["publish"] = 0;
        }
        if($data['lang'] != 'all'){
            
            $page = Page::firstOrCreate(['slug' => $data['slug']] , 
        ['slug' => $data['slug'], 'publish' => $data['publish'], 'template' => $data['template']]); 


        // for langs data

        if(isset($data['title'])){
            $content = '<html>'. $data['content'] .'</html>';
            $dom = new \DOMDocument('1.0', 'UTF-8');
            $dom->loadHtml("\xEF\xBB\xBF" .$content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $dom->getElementsByTagName('img');

            foreach($imageFile as $item => $image){
                $imageSrc = $image->getAttribute('src');
                $imageName = $image->getAttribute('data-filename');
                
                if(substr($imageSrc, 0, 4) == 'data'){

                    list($type, $imageSrc) = explode(';', $imageSrc);

                    list(, $imageSrc)   = explode(',', $imageSrc);
    
                    $imgeData = base64_decode( $imageSrc);

                   Storage::disk('public')->put('images/'.$imageName, $imgeData);

                   $filePath = asset('/storage/images/'.$imageName);
                 
                    $image->removeAttribute('src');
                    $image->setAttribute('src', url($filePath));
                }
                 
            }
            $content = html_entity_decode(str_replace(array('<html>','</html>') , '' , $dom->saveHTML()));
 
             
            PageLangs::firstOrCreate(['page_id' => $page->id, 'title' => $data['title'], 'lang' => $data['lang']],
        ['title' => $data['title'], 'content' => $content, 'lang' => $data['lang']]
            );
        }

        // for meta data

        if(isset($data['metas'])){
            foreach($data['metas'] as $key => $elem){
                
               PageMeta::firstOrCreate(['page_id' => $page->id, 'name' => $key, 'lang' => $data['lang']],
               ['name' => $key, 'content' => $elem, 'lang' => $data['lang']] 
            ); 
          

            }
             
        }
    }else{
        foreach($languages as $language){
            if($language == 'en'){
                $translatelang = 'English';
            }else if($language == 'fr'){
                $translatelang = 'French';
            }

            $page = Page::firstOrCreate(['slug' => $data['slug']] , 
            ['slug' => $data['slug'], 'publish' => $data['publish'], 'template' => $data['template']]); 


            // for langs data

            if(isset($data['title'])){
                $content = '<html>'. $data['content'] .'</html>';
                $dom = new \DOMDocument('1.0', 'UTF-8');
                $dom->loadHtml("\xEF\xBB\xBF" .$content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $imageFile = $dom->getElementsByTagName('img');

                foreach($imageFile as $item => $image){
                    $imageSrc = $image->getAttribute('src');
                    $imageName = $image->getAttribute('data-filename');
                    
                    if(substr($imageSrc, 0, 4) == 'data'){

                        list($type, $imageSrc) = explode(';', $imageSrc);

                        list(, $imageSrc)   = explode(',', $imageSrc);
        
                        $imgeData = base64_decode( $imageSrc);

                    Storage::disk('public')->put('images/'.$imageName, $imgeData);

                    $filePath = asset('/storage/images/'.$imageName);
                    
                        $image->removeAttribute('src');
                        $image->setAttribute('src', url($filePath));
                    }
                    
                }
                $content = html_entity_decode(str_replace(array('<html>','</html>') , '' , $dom->saveHTML()));
    
                if($language != 'ru'){
                    // $result1 = $this->openAIService->translate($content, $translatelang);
                   //  $newContent =   $result1[0]['content'];
               
   
                   //  $result2 = $this->openAIService->translate($data['title'], $translatelang);
                   // $newTitle =   $result2[0]['content'];
                 }

                PageLangs::firstOrCreate(['page_id' => $page->id, 'title' => $data['title'], 'lang' => $language],
            ['title' => $data['title'], 'content' => $content, 'lang' => $language]
                );
            }

            // for meta data

            if(isset($data['metas'])){
                foreach($data['metas'] as $key => $elem){
                    
                    if($language != 'ru'){
                        //   $result = $this->openAIService->translate($elem['content'], $translatelang);
                        //   $newContent =   $result[0]['content'];
                        }


                PageMeta::firstOrCreate(['page_id' => $page->id, 'name' => $key, 'lang' => $language],
                ['name' => $key, 'content' => $elem, 'lang' => $language] 
                ); 
            

                }
                
            }
        }

    }
        return $page;
        //return redirect()->route("admin.page.index");
        //return new PageResource($page);
    }
}
