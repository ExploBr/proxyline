<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowPostController extends Controller
{
    public function __invoke(Request $request){
        return view("post.index");
    }
}
