<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class EditController extends Controller
{
    public function __invoke(Page $page){
        
        $page = Page::where('page_langs.page_id', '=', $page->id)
        ->where('page_langs.lang','=', app()->getLocale())
        ->leftJoin('page_langs','pages.id', '=','page_langs.page_id')->firstOr(function () {
            abort(404);
        });

        $page_metas = Page::where('page_metas.page_id', '=', $page->id)
        ->where('page_metas.lang','=', app()->getLocale())
        ->leftJoin('page_metas','pages.id', '=','page_metas.page_id')->get();
        
        return view("admin.page.edit",compact("page", 'page_metas'));
   
    }
}
