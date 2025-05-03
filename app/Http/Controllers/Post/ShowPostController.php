<?php

namespace App\Http\Controllers\Post;

 
use App\Models\MainContentOptions;
use App\Models\MainOption;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
 
use App\Models\Post;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session as FacadesSession;

class ShowPostController extends Controller
{
    public function __invoke(Post $post){
      
        $page = Post::where('post_langs.post_id', '=', $post->id)
        ->where('post_langs.lang','=', app()->getLocale())
        ->where('posts.publish','=', '1')
        ->leftJoin('post_langs','posts.id', '=','post_langs.post_id')->firstOr(function () {
            abort(404);
        });
         
        $pageAll = Post::where('post_langs.post_id', '!=', $post->id)
        ->where('post_langs.lang','=', app()->getLocale())
        ->where('posts.publish','=', '1')
        ->leftJoin('post_langs','posts.id', '=','post_langs.post_id')->get();
         

         $page_seo = Post::where('seo_infos.post_id', '=', $page->page_id)
         ->where('seo_infos.lang','=', app()->getLocale())
        ->leftJoin('seo_infos','posts.id', '=','seo_infos.post_id')->select( 'name', 'content','lang')
        ->get();
        $page_seo = json_decode($page_seo);
        
        $socials = MainOption::where('name', '=',  "socials")->value('content');
        $socials = json_decode($socials);
 
        $affilateblock = MainContentOptions::where('name','=', 'affilateblock')->value('content'); 

        
        $menu_top = MainOption::where('name', '=',  "menu_top")->value('content');
        $menu_top = json_decode($menu_top);

        $menu_info = MainOption::where('name', '=', 'menu_info')
        ->value('content');
    
        $menu_info  = json_decode($menu_info);

        $menu_main_bottom = MainOption::where('name', '=', 'menu_main_bottom')
        ->value('content');
    
        $menu_main_bottom  = json_decode($menu_main_bottom);
        
        $course_usd = DB::table('api_info')->where('name', '=',  "course_usd")->value('content');

   
 
        return view("post.index",compact("page" ,'pageAll',"menu_top",'course_usd','menu_info','menu_main_bottom','socials','page_seo', 'affilateblock'));
    }
}
