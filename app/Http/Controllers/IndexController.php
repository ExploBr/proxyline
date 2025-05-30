<?php

namespace App\Http\Controllers;

use App\Models\MainContentOptions;
use App\Models\MainOption;
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
         
        $modal_info = MainContentOptions::where('name', '=',  "calculatorblock")->value('content');
        $modal_info = json_decode($modal_info);

        $reviews_ru = MainOption::where('name', '=',  "reviews_ru")->value('content');
        $reviews_ru = json_decode($reviews_ru);


        $reviews_en = MainOption::where('name', '=',  "reviews_en")->value('content');
        $reviews_en = json_decode($reviews_en);

        $menu_top = MainOption::where('name', '=',  "menu_top")->value('content');
        $menu_top = json_decode($menu_top);

        $menu_info = MainOption::where('name', '=', 'menu_info')
        ->value('content');
    
        $menu_info  = json_decode($menu_info);

        $menu_main_bottom = MainOption::where('name', '=', 'menu_main_bottom')
        ->value('content');
    
        $menu_main_bottom  = json_decode($menu_main_bottom);


        $socials = MainOption::where('name', '=',  "socials")->value('content');
        $socials = json_decode($socials);

        $course_usd = DB::table('api_info')->where('name', '=',  "course_usd")->value('content');

        

        return view("index", 
        compact("page", 'advantages', 'whereuse', 'seoblock', 'affilateblock', 'data_calculator', 'modal_info', 'reviews_ru', 'reviews_en', 'menu_top', 'socials', 'course_usd', 'menu_info', 'menu_main_bottom'));
    }
}
