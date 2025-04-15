<?php

namespace App\Http\Controllers\Admin\Page;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Page\UpdateRequest;
use App\Models\Page;
use App\Models\PageLangs;
use App\Models\PageMeta;
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

        $languages = ['ru','en','fr'];

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
     
                PageLangs::
                      updateOrCreate(['page_id' => $page->id, 'lang' => $data['lang']],
                     ['page_id'=>$page->id,'title' => $data['title'], 'content' => $content, 'lang' => $data['lang']] );
            } 


            if(isset($data['metas'])){
                foreach($data['metas'] as $key => $elem){
                    
                    PageMeta::
                    updateOrCreate(['page_id' =>  $page->id, 'name' => $elem['name'], 'lang' => $data['lang'] ],['name' => $elem['name'], 'content' => $elem['content'], 'lang' => $data['lang']]  ); 
                     
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
            }


            if(isset($data["publish"])){
                $data["publish"] == true ? $data["publish"] = 1 : $data["publish"] = 0;
            }
            $page->update(['slug' => $data['slug'], 'publish' => $data['publish'], 'template' => $data['template']]);
      
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

                      PageLangs::
                      updateOrCreate(['page_id' => $page->id, 'lang' => $language],
                     ['page_id'=>$page->id,'title' => $data['title'], 'content' => $content, 'lang' => $language] );
 
                } 
        
                
                // for meta data
        
                  if(isset($data['metas'])){
                    foreach($data['metas'] as $key => $elem){

                        if($language != 'ru'){
                        //   $result = $this->openAIService->translate($elem['content'], $translatelang);
                        //   $newContent =   $result[0]['content'];
                        }

                        PageMeta::
                        updateOrCreate(['page_id' =>  $page->id, 'name' => $elem['name'], 'lang' => $language ],['name' => $elem['name'], 'content' => $elem['content'], 'lang' => $language]  ); 
                          
                    }
                     
                }   
  

        }
    }
         
        return $page;

    }
}
