<?php

namespace App\Http\Controllers;

use App\Models\MainContentOptions;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function __invoke(){
        $page = Page::find(1);
         
        $page = Page::where('page_langs.page_id', '=', $page->id)
        ->where('page_langs.lang','=', app()->getLocale())
        ->leftJoin('page_langs','pages.id', '=','page_langs.page_id')->firstOr(function () {
            abort(404);
        });
        
        $advantages = MainContentOptions::where('name','=', 'advantages')->value('content');  
        $advantages = json_decode($advantages);

        $whereuse = MainContentOptions::where('name','=', 'whereuse')->value('content'); 
        $whereuse = json_decode($whereuse);

        $seoblock = MainContentOptions::where('name','=', 'seoblock')->value('content'); 
        $affilateblock = MainContentOptions::where('name','=', 'affilateblock')->value('content'); 

        $data_calculator = DB::table('api_info')->where('name', '=', 'calculator_data')->value('content');
        $data_calculator = json_decode($data_calculator);

        return view("index", compact("page", 'advantages', 'whereuse', 'seoblock', 'affilateblock', 'data_calculator'));
    }
}
