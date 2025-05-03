<?php

namespace App\Http\Controllers\Page;

use App\Helpers\AvailabilityCountries;
use App\Models\MainContentOptions;
use App\Models\MainOption;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Post;
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
        
        if(isset($_GET['search'])){
            $search = $_GET['search'];
        }else{ 
            $search = '';
        }
        $posts = Post::query()
        ->where('post_langs.lang', '=', 'ru')
        ->where('posts.publish', '=', '1')
        ->where('post_langs.title', 'like', '%'.$search.'%')
        ->leftJoin('post_langs','posts.id', '=','post_langs.post_id')
         
        ->paginate(5);

        $page_metas = Page::where('page_metas.page_id', '=', $page->page_id)
          ->where('page_metas.lang','=', app()->getLocale())
         ->leftJoin('page_metas','pages.id', '=','page_metas.page_id')->select( 'name', 'content','lang')
         ->get();
         $page_metas = json_decode($page_metas);

         $page_seo = Page::where('seo_infos.page_id', '=', $page->page_id)
         ->where('seo_infos.lang','=', app()->getLocale())
        ->leftJoin('seo_infos','pages.id', '=','seo_infos.page_id')->select( 'name', 'content','lang')
        ->get();
        $page_seo = json_decode($page_seo);
        
         

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

        $countriesData = DB::table('api_info')->where('name', '=',  "countries-data")->value('content');
        $countriesData = json_decode($countriesData);
         

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
        elseif($page->template == 'faq'){
       
            if($page_metas[0]->name == 'faq1' || $page_metas[0]->name == 'faq2'){
                for ($i=0; $i < count($page_metas); $i++) { 
                  
                  $page_metas[$i]->content = json_decode($page_metas[$i]->content);
                }
                             
              }
              $data_mass = [ 'affilateblock'];
        }
        elseif($page->template == 'apipage'){
           
            $data_mass=['countriesData'];
        }
        elseif($page->template == 'instruction'){
           
            $data_mass=['affilateblock', 'posts'];
        }
        else{
            $data_mass = [];
        }
        return view("page.index",compact("page" ,"page_metas","menu_top",'socials','course_usd','menu_info','menu_main_bottom','page_seo', $data_mass));
    }
}
