<?php

namespace App\Http\Controllers\Admin\Posts;


use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class DestroyController extends BaseController
{
    public function __invoke(Page $page){
        $page->delete();
        return redirect()->route("admin.page.index", );
    }
}
