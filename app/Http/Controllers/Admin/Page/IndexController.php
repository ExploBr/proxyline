<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
class IndexController extends Controller
{
    public function __invoke(){


         
        if(isset($_GET['search'])){
            $search = $_GET['search'];
        }else{ 
            $search = '';
        }
        $pages = Page::query()
        ->where('page_langs.lang', '=', 'ru')
        ->where('page_langs.title', 'like', '%'.$search.'%')
        ->leftJoin('page_langs','pages.id', '=','page_langs.page_id')
         
        ->paginate(30);


        $pages_meta = Page::query()
         ->where('page_metas.lang', '=', 'ru')
        ->leftJoin('page_metas','pages.id', '=','page_metas.page_id')
        ->paginate(30);
        
     
       return view("admin.page.index", compact("pages", "pages_meta"));
    }
}
