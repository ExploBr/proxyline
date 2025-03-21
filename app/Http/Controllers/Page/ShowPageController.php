<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Route;

class ShowPageController extends Controller
{
    public function __invoke(Page $page){
       
        if($page->id == 1){
             
             
        } 
        $page = Page::find($page->id);
        return view("page.index",compact("page"));
    }
}
