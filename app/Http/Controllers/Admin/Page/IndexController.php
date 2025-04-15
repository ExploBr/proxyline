<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
class IndexController extends Controller
{
    public function __invoke(){


         

        $pages = Page::query()
        ->where('page_langs.lang', '=', 'ru')
        ->leftJoin('page_langs','pages.id', '=','page_langs.page_id')
         
        ->paginate(10);


        $pages_meta = Page::query()
         ->where('page_metas.lang', '=', 'ru')
        ->leftJoin('page_metas','pages.id', '=','page_metas.page_id')
        ->paginate(10);
        
    
        
       //return ['data' => 'adssa'];
       return view("admin.page.index", compact("pages", "pages_meta"));
    }
}
