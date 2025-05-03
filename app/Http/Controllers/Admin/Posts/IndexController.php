<?php

namespace App\Http\Controllers\Admin\Posts;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class IndexController extends Controller
{
    public function __invoke(){


         
        if(isset($_GET['search'])){
            $search = $_GET['search'];
        }else{ 
            $search = '';
        }
        $posts = Post::query()
        ->where('post_langs.lang', '=', 'ru')
        ->where('post_langs.title', 'like', '%'.$search.'%')
        ->leftJoin('post_langs','posts.id', '=','post_langs.post_id')
         
        ->paginate(30);
        
     
       return view("admin.posts.index", compact("posts", ));
    }
}
