<?php

namespace App\Http\Controllers\Admin\Posts;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class EditController extends Controller
{
    public function __invoke(Post $post){
        
        $post = Post::where('post_langs.post_id', '=', $post->id)
        ///->where('page_langs.lang','=', app()->getLocale())
        ->leftJoin('post_langs','posts.id', '=','post_langs.post_id')
        ->select('posts.id','post_id','title', 'content','lang','posts.slug','posts.preview','content', 'publish')
        ->get();

         
        foreach($post as $element){
       
        $post_seo = Post::where('seo_infos.post_id', '=', $element->post_id)
        // ->where('page_metas.lang','=', app()->getLocale())
         ->leftJoin('seo_infos','posts.id', '=','seo_infos.post_id')->select( 'name', 'content','lang')
         ->get();
        }
        $firstPost = $post[0];
        
        return view("admin.posts.edit",compact("post",   'firstPost', 'post_seo'));
   
    }
}
