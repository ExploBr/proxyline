<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(){
        $page = Page::find(1);

        $page = Page::where('page_langs.page_id', '=', $page->id)
        ->where('page_langs.lang','=', app()->getLocale())
        ->leftJoin('page_langs','pages.id', '=','page_langs.page_id')->firstOr(function () {
            abort(404);
        });
        return view("index", compact("page"));
    }
}
