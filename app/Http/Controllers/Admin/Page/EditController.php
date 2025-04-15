<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class EditController extends Controller
{
    public function __invoke(Page $page){
        
        $page = Page::where('page_langs.page_id', '=', $page->id)
        ///->where('page_langs.lang','=', app()->getLocale())
        ->leftJoin('page_langs','pages.id', '=','page_langs.page_id')
        ->select('pages.id','page_id','title', 'content','lang','pages.slug','pages.template','content', 'publish')
        ->get();

         
        foreach($page as $element){
        $page_metas = Page::where('page_metas.page_id', '=', $element->page_id)
       // ->where('page_metas.lang','=', app()->getLocale())
        ->leftJoin('page_metas','pages.id', '=','page_metas.page_id')->select( 'name', 'content','lang')
        ->get();
        }
        $firstPage = $page[0];
        
        return view("admin.page.edit",compact("page", 'page_metas', 'firstPage'));
   
    }
}
