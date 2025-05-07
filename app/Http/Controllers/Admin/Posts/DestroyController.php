<?php

namespace App\Http\Controllers\Admin\Posts;


use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class DestroyController extends BaseController
{
    public function __invoke(Post $page){
        $page->delete();
        return redirect()->route("admin.post.index", );
    }
}
