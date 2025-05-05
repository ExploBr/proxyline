<?php

namespace App\Http\Controllers\Admin\Page;

use App\Helpers\DomCreate;
use App\Helpers\Langs;
use App\Http\Controllers\Controller;
use App\Models\SeoInfo;
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
        
       $languages = Langs::LOCALES;
        // create page

        if(isset($data["publish"])){
            $data["publish"] == true ? $data["publish"] = 1: $data["publish"] = 0;
        }else{
            $data["publish"] = 0;
        }



        if($data['lang'] != 'all'){
            
             $page = Page::firstOrCreate(['slug' => $data['slug']] , 
        ['slug' => $data['slug'], 'publish' => $data['publish'], 'template' => $data['template']]); 


        // for langs data

        if(isset($data['title'])){
             
             if(isset($data['content'])){
            $content = DomCreate::createDom($data['content']);
             }else{
            $content = null;
             }
            PageLangs::firstOrCreate(['page_id' => $page->id, 'title' => $data['title'], 'lang' => $data['lang']],
        ['title' => $data['title'], 'content' => $content, 'lang' => $data['lang']]
            );
        } 

        // for meta data

        if(isset($data['metas'])){
            foreach($data['metas'] as $key => $elem){
          
                
                if($key == 'ipv_content_top' || $key == 'ipv_content_bottom' || $key == 'steps'){
                    $elem = DomCreate::createDom($elem);
                }    
                if($key == 'faq1' || $key == 'faq2'){
                    $elem = json_encode($elem, JSON_UNESCAPED_UNICODE);
                }
            
               PageMeta::firstOrCreate(['page_id' => $page->id, 'name' => $key, 'lang' => $data['lang']],
               ['name' => $key, 'content' => $elem, 'lang' => $data['lang']] 
            ); 
          

            }
             
        }


         if(isset($data['seo'])){
            foreach($data['seo'] as $key => $elem){    
                SeoInfo::firstOrCreate(['page_id' => $page->id, 'name' => $key, 'lang' => $data['lang']],
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
            }else if($language == 'de'){
                $translatelang = 'Deutsch';
            }else if($language == 'ze'){
                $translatelang = 'Chinese';
            }
            else if($language == 'hi'){
                $translatelang = 'Hindi';
            }
            else if($language == 'es'){
                $translatelang = 'Spanish';
            }
            else if($language == 'pt'){
                $translatelang = 'Portuguese';
            }
            else if($language == 'uk'){
                $translatelang = 'Ukrainian';
            }
            else if($language == 'be'){
                $translatelang = 'Belarusian';
            }
            else if($language == 'lt'){
                $translatelang = 'Lithuanian';
            }
            else if($language == 'lv'){
                $translatelang = 'Latvian';
            }
            else if($language == 'pl'){
                $translatelang = 'Poland';
            }
            else if($language == 'cs'){
                $translatelang = 'Czech';
            }
            else if($language == 'az'){
                $translatelang = 'Azerbaijan';
            }
            else if($language == 'et'){
                $translatelang = 'Estonian';
            }
            else if($language == 'ro'){
                $translatelang = 'Romanian';
            }
            else if($language == 'kk'){
                $translatelang = 'Kazakh';
            }
            else if($language == 'it'){
                $translatelang = 'Italian';
            }
            else if($language == 'nl'){
                $translatelang = 'Dutch';
            }
            else if($language == 'tr'){
                $translatelang = 'Turkish';
            }
            else if($language == 'id'){
                $translatelang = 'Indonesia';
            }

            $page = Page::firstOrCreate(['slug' => $data['slug']] , 
            ['slug' => $data['slug'], 'publish' => $data['publish'], 'template' => $data['template']]); 


            // for langs data

            if(isset($data['title'])){
 
                if(isset($data['content'])){
                    $content = DomCreate::createDom($data['content']);
                     }else{
                    $content = null;
                     }

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

                 
                    if($key == 'ipv_content_top' || $key == 'ipv_content_bottom' || $key == 'steps'){
                        $elem = DomCreate::createDom($elem);
                     }    
                     if($key == 'faq1' || $key == 'faq2'){
                        $elem = json_encode($elem, JSON_UNESCAPED_UNICODE);
                    }
 

                PageMeta::firstOrCreate(['page_id' => $page->id, 'name' => $key, 'lang' => $language],
                ['name' => $key, 'content' => $elem, 'lang' => $language] 
                ); 
            

                }
                
            }

            if(isset($data['seo'])){
                

                foreach($data['seo'] as $key => $elem){   
                    
                    if($language != 'ru'){
                        //   $result = $this->openAIService->translate($elem['content'], $translatelang);
                        //   $newContent =   $result[0]['content'];
                        }


                    SeoInfo::firstOrCreate(['page_id' => $page->id, 'name' => $key, 'lang' => $language],
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
