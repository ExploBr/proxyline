<?php

namespace App\Http\Controllers\Admin\Posts;


use App\Helpers\DomCreate;
use App\Helpers\Langs;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;
use App\Models\PostLangs;
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
    public function __invoke(UpdateRequest $request, Post $post){
        
    
        $data = $request->validated();
        
        $languages = Langs::LOCALES;

        $postsslug = Post::where("slug", $data["slug"])->value('slug');

        if($data["slug"] == $postsslug && $postsslug != $post->slug){
            return 'slug error';
        }

        // update for one lang

        if($data['lang'] != 'all'){
            if(isset($data["publish"])){
                $data["publish"] == true ? $data["publish"] = 1 : $data["publish"] = 0;
            }
            if(isset($data['preview'])){
                $data['preview'] = DomCreate::createDom($data['preview']);
            }else{
                $data['preview'] = '';
            }
            $post->update(['slug' => $data['slug'], 'publish' => $data['publish'], 'created' => $data['created'], 'preview' => $data['preview']]);


            if(isset($data['title'])){

                $content = DomCreate::createDom($data['content']);
     
                PostLangs::
                      updateOrCreate(['post_id' => $post->id, 'lang' => $data['lang']],
                     ['post_id'=>$post->id,'title' => $data['title'], 'content' => $content, 'lang' => $data['lang']] );
            } 
 
            if(isset($data['seo'])){
                foreach($data['seo'] as $key => $elem){    
                    SeoInfo::updateOrCreate(['post_id' => $post->id, 'name' => $elem['name'], 'lang' => $data['lang']],
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
            if(isset($data['preview'])){
                $data['preview'] = DomCreate::createDom($data['preview']);
            }else{
                $data['preview'] = '';
            }
            $post->update(['slug' => $data['slug'], 'publish' => $data['publish'], 'preview' => $data['preview'], 'created' => $data['created']]);
      
                // for langs data
        
                if(isset($data['title'])){
                     
                    $content = DomCreate::createDom($data['content']);

         
                      if($language != 'ru'){
                         // $result1 = $this->openAIService->translate($content, $translatelang);
                        //  $newContent =   $result1[0]['content'];
                    
        
                        //  $result2 = $this->openAIService->translate($data['title'], $translatelang);
                        // $newTitle =   $result2[0]['content'];
                      }

                      PostLangs::
                      updateOrCreate(['post_id' => $post->id, 'lang' => $language],
                     ['post_id'=>$post->id,'title' => $data['title'], 'content' => $content, 'lang' => $language] );
 
                } 
        
                
                // for meta data
        
 
                if(isset($data['seo'])){
                    foreach($data['seo'] as $key => $elem){    
                        
                        if($language != 'ru'){
                            //   $result = $this->openAIService->translate($elem['content'], $translatelang);
                            //   $newContent =   $result[0]['content'];
                            }

                            SeoInfo::updateOrCreate(['post_id' => $post->id, 'name' => $elem['name'], 'lang' => $data['lang']],
                            ['name' => $elem['name'], 'content' => $elem['content'], 'lang' => $data['lang']] 
                    ); 
                  
        
                    }
                     
                }
  

        }
    }
         
        return $post;

    }
}
