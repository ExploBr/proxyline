<?php

namespace App\Http\Controllers\Admin\Posts;


use App\Helpers\DomCreate;
use App\Http\Controllers\Controller;
use App\Models\SeoInfo;
use Illuminate\Http\Request;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use App\Models\PostLangs;
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
        }else{
            $data["publish"] = 0;
        }



        if($data['lang'] != 'all'){
            if(isset($data['preview'])){
                $preview = DomCreate::createDom($data['preview']);
            }else{
                $preview = null;
            }
             $post = Post::firstOrCreate(['slug' => $data['slug']] , 
        ['slug' => $data['slug'], 'publish' => $data['publish'], 'preview' => $preview, 'created' => $data['created']]); 
          

        // for langs data

        if(isset($data['title'])){
             
             if(isset($data['content'])){
            $content = DomCreate::createDom($data['content']);
             }else{
            $content = null;
             }

            PostLangs::firstOrCreate(['post_id' => $post->id, 'title' => $data['title'], 'lang' => $data['lang']],
        ['title' => $data['title'], 'content' => $content, 'lang' => $data['lang']]
            );
        } 
         

        // for meta data
 
         if(isset($data['seo'])){
            foreach($data['seo'] as $key => $elem){    
                SeoInfo::firstOrCreate(['post_id' => $post->id, 'name' => $key, 'lang' => $data['lang']],
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

            if(isset($data['preview'])){
                $preview = DomCreate::createDom($data['preview']);
            }else{
                $preview = null;
            }
             $post = Post::firstOrCreate(['slug' => $data['slug']] , 
        ['slug' => $data['slug'], 'publish' => $data['publish'], 'preview' => $preview, 'created' => $data['created']]); 
          
  


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

                PostLangs::firstOrCreate(['post_id' => $post->id, 'title' => $data['title'], 'lang' => $language],
            ['title' => $data['title'], 'content' => $content, 'lang' => $language]
                );
            }

            // for meta data
 

            if(isset($data['seo'])){
                

                foreach($data['seo'] as $key => $elem){   
                    
                    if($language != 'ru'){
                        //   $result = $this->openAIService->translate($elem['content'], $translatelang);
                        //   $newContent =   $result[0]['content'];
                        }


                    SeoInfo::firstOrCreate(['post_id' => $post->id, 'name' => $key, 'lang' => $language],
                   ['name' => $key, 'content' => $elem, 'lang' => $language] 
                ); 
              
    
                }
                 
            }

        }

    }
        return $post;
 
    }
}
