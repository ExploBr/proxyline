<?php

namespace App\Http\Controllers\Page;

use App\Helpers\AvailabilityCountries;
use App\Models\MainContentOptions;
use App\Models\MainOption;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session as FacadesSession;

class ShowPageController extends Controller
{
    public function __invoke(Page $page){
       
        if($page->id == 1){
                 
        } 
        $page = Page::where('page_langs.page_id', '=', $page->id)
        ->where('page_langs.lang','=', app()->getLocale())
        ->where('pages.publish','=', '1')
        ->leftJoin('page_langs','pages.id', '=','page_langs.page_id')->firstOr(function () {
            abort(404);
        });

        $page_metas = Page::where('page_metas.page_id', '=', $page->page_id)
          ->where('page_metas.lang','=', app()->getLocale())
         ->leftJoin('page_metas','pages.id', '=','page_metas.page_id')->select( 'name', 'content','lang')
         ->get();
         $page_metas = json_decode($page_metas);
         

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

        $socials = MainOption::where('name', '=',  "socials")->value('content');
        $socials = json_decode($socials);
        
        $menu_top = MainOption::where('name', '=',  "menu_top")->value('content');
        $menu_top = json_decode($menu_top);

        $menu_info = MainOption::where('name', '=', 'menu_info')
        ->value('content');
    
        $menu_info  = json_decode($menu_info);

        $menu_main_bottom = MainOption::where('name', '=', 'menu_main_bottom')
        ->value('content');
    
        $menu_main_bottom  = json_decode($menu_main_bottom);
        
        $course_usd = DB::table('api_info')->where('name', '=',  "course_usd")->value('content');

        $prices = DB::table('api_info')->where('name', '=',  "prices")->value('content');
        $prices = json_decode($prices);

        $payments = DB::table('api_info')->where('name', '=',  "payments")->value('content');
        $payments = json_decode($payments);

        //$data_mass = ["page_metas", 'advantages', 'whereuse', 'seoblock', 'affilateblock', 'data_calculator', 'modal_info', 'reviews_ru', 'reviews_en'];
        if($page->template == 'ipv'){
            $data_mass = [ 'advantages','affilateblock', 'data_calculator', 'modal_info', 'reviews_ru', 'reviews_en'];
        }
        elseif($page->template == 'contact'){
            $data_mass = [ 'affilateblock'];
        }
        elseif($page->template == 'optovikam'){
            $data_mass = [ 'affilateblock'];
        }
        elseif($page->template == 'ceny' || $page->template == 'pay'){
            $countries_list = [ 
                'shared:4' => AvailabilityCountries::get_availability_countries('shared:4'),
                'dedicated:4' => AvailabilityCountries::get_availability_countries('dedicated:4'),
                'dedicated:6' => AvailabilityCountries::get_availability_countries('dedicated:6'),
            ];
            
            $data = session('data');
            $data_mass = [ 'prices', 'countries_list', 'data_calculator' , 'payments', 'data'];
        }
        elseif($page->template == 'txtpage'){
            $data_mass = [ 'affilateblock'];
        }
        else{
            $data_mass = [];
        }
        return view("page.index",compact("page" ,"page_metas","menu_top",'socials','course_usd','menu_info','menu_main_bottom', $data_mass));
    }
}
