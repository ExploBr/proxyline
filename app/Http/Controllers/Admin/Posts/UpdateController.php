<?php

namespace App\Http\Controllers\Admin\Posts;


use App\Helpers\DomCreate;
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
        
        $languages = ['ru','en','fr'];

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
