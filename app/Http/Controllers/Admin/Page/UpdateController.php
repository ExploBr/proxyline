<?php

namespace App\Http\Controllers\Admin\Page;

use App\Helpers\DomCreate;
use App\Helpers\Langs;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Page\UpdateRequest;
use App\Models\Page;
use App\Models\PageLangs;
use App\Models\PageMeta;
use App\Models\SeoInfo;
use Illuminate\Support\Facades\Storage;
use App\Services\OpenAIService;

class UpdateController extends BaseController
{
    protected $openAIService;
    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }
    public function __invoke(UpdateRequest $request, Page $page){
        
    
        $data = $request->validated();
        
        $languages = Langs::LOCALES;

        $pagesslug = Page::where("slug", $data["slug"])->value('slug');

        if($data["slug"] == $pagesslug && $pagesslug != $page->slug){
            return 'slug error';
        }

        // update for one lang

        if($data['lang'] != 'all'){
            if(isset($data["publish"])){
                $data["publish"] == true ? $data["publish"] = 1 : $data["publish"] = 0;
            }
            $page->update(['slug' => $data['slug'], 'publish' => $data['publish'], 'template' => $data['template']]);


            if(isset($data['title'])){

                $content = DomCreate::createDom($data['content']);
     
                PageLangs::
                      updateOrCreate(['page_id' => $page->id, 'lang' => $data['lang']],
                     ['page_id'=>$page->id,'title' => $data['title'], 'content' => $content, 'lang' => $data['lang']] );
            } 


            if(isset($data['metas'])){
                foreach($data['metas'] as $key => $elem){
                     if($elem['name'] == 'ipv_content_top' || $elem['name'] == 'ipv_content_bottom' || $elem['name'] == 'steps'){
                        $elem['content'] = DomCreate::createDom($elem['content']);
                    }    

                    if($elem['name'] == 'faq1' || $elem['name'] == 'faq2'){
                        $elem['content'] = json_encode($elem['content'], JSON_UNESCAPED_UNICODE);
                    }
                    PageMeta::
                    updateOrCreate(['page_id' =>  $page->id, 'name' => $elem['name'], 'lang' => $data['lang'] ],['name' => $elem['name'], 'content' => $elem['content'], 'lang' => $data['lang']]  ); 
                     
                }                 
            }   

            if(isset($data['seo'])){
                foreach($data['seo'] as $key => $elem){    
                    SeoInfo::updateOrCreate(['page_id' => $page->id, 'name' => $elem['name'], 'lang' => $data['lang']],
                   ['name' => $elem['name'], 'content' => $elem['content'], 'lang' => $data['lang']] 
                ); 
              
    
                }
                 
            }

            

        }
        // update for all lang, ru-main
        else{
        foreach($languages as $language){

            //name for chatgpt

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


            if(isset($data["publish"])){
                $data["publish"] == true ? $data["publish"] = 1 : $data["publish"] = 0;
            }
            $page->update(['slug' => $data['slug'], 'publish' => $data['publish'], 'template' => $data['template']]);
      
                // for langs data
        
                if(isset($data['title'])){
                     
                    $content = DomCreate::createDom($data['content']);

         
                      if($language != 'ru'){
                         // $result1 = $this->openAIService->translate($content, $translatelang);
                        //  $newContent =   $result1[0]['content'];
                    
        
                        //  $result2 = $this->openAIService->translate($data['title'], $translatelang);
                        // $newTitle =   $result2[0]['content'];
                      }

                      PageLangs::
                      updateOrCreate(['page_id' => $page->id, 'lang' => $language],
                     ['page_id'=>$page->id,'title' => $data['title'], 'content' => $content, 'lang' => $language] );
 
                } 
        
                
                // for meta data
        
                  if(isset($data['metas'])){
                    foreach($data['metas'] as $key => $elem){

                        if($elem['name'] == 'ipv_content_top' || $elem['name'] == 'ipv_content_bottom' || $elem['name'] == 'steps'){
                            $elem['content'] = DomCreate::createDom($elem['content']);
                        } 
                        
                        if($language != 'ru'){
                        //   $result = $this->openAIService->translate($elem['content'], $translatelang);
                        //   $newContent =   $result[0]['content'];
                        }

                        
                        PageMeta::
                        updateOrCreate(['page_id' =>  $page->id, 'name' => $elem['name'], 'lang' => $language ],['name' => $elem['name'], 'content' => $elem['content'], 'lang' => $language]  ); 
                          
                    }
                     
                }   

                if(isset($data['seo'])){
                    foreach($data['seo'] as $key => $elem){    
                        
                        if($language != 'ru'){
                            //   $result = $this->openAIService->translate($elem['content'], $translatelang);
                            //   $newContent =   $result[0]['content'];
                            }

                            SeoInfo::updateOrCreate(['page_id' => $page->id, 'name' => $elem['name'], 'lang' => $data['lang']],
                            ['name' => $elem['name'], 'content' => $elem['content'], 'lang' => $data['lang']] 
                    ); 
                  
        
                    }
                     
                }
  

        }
    }
         
        return $page;

    }
}
