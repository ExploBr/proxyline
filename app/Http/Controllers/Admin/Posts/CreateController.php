<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke(Post $post){

      
         
        return view("admin.posts.create" , compact(  "post"));
     
      }
}
