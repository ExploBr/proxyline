<?php

namespace App\Http\Controllers\Page;

use App\Helpers\AvailabilityCountries;
use App\Models\MainContentOptions;
use App\Models\MainOption;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\PageLangs;
use App\Models\PageMeta;
use App\Models\Post;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session as FacadesSession;

use function Laravel\Prompts\select;

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

         $page_seo = Page::where('seo_infos.page_id', '=', $page->page_id)
         ->where('seo_infos.lang','=', app()->getLocale())
        ->leftJoin('seo_infos','pages.id', '=','seo_infos.page_id')->select( 'name', 'content','lang')
        ->get();
         $page_seo = json_decode($page_seo);
        
 

       // $whereuse = MainContentOptions::where('name','=', 'whereuse')->value('content'); 
      // $whereuse = json_decode($whereuse);

       // $seoblock = MainContentOptions::where('name','=', 'seoblock')->value('content'); 

        $affilateblock = MainContentOptions::where('name','=', 'affilateblock')->value('content'); 

        $data_calculator = DB::table('api_info')->where('name', '=', 'calculator_data')->value('content');
        $data_calculator = json_decode($data_calculator);
         
        $modal_info = MainContentOptions::where('name', '=',  "calculatorblock")->value('content');
        $modal_info = json_decode($modal_info);

        


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


        $menu_main_country = MainOption::where('name', '=', 'menu_main_country')
        ->value('content');
        $menu_main_country  = json_decode($menu_main_country);

        
        $menu_main_podmenu = MainOption::where('name', '=', 'menu_main_podmenu')
        ->value('content');
        $menu_main_podmenu  = json_decode($menu_main_podmenu);


        $all_payments = MainOption::where('name', '=', 'methods')
        ->value('content');
        $all_payments  = json_decode( $all_payments);


        $course_usd = DB::table('api_info')->where('name', '=',  "course_usd")->value('content');


        $catalog = MainOption::where('name', '=', 'catalog')
        ->value('content');
        $catalog  = json_decode( $catalog);

        $allstats = DB::table('api_info')->where('name', '=',  "stats")->value('content');
        $allstats = json_decode( $allstats);


         
        if($page->template == 'ipv'){
            $reviews_ru = MainOption::where('name', '=',  "reviews_ru")->value('content');
            $reviews_ru = json_decode($reviews_ru);
    
    
            $reviews_en = MainOption::where('name', '=',  "reviews_en")->value('content');
            $reviews_en = json_decode($reviews_en);

            $advantages = MainContentOptions::where('name','=', 'advantages')->value('content');  
            $advantages = json_decode($advantages);

            $data_mass = [ 'advantages','affilateblock', 'data_calculator', 'modal_info', 'reviews_ru', 'reviews_en'];
        }


        elseif($page->template == 'contact'){
            $data_mass = [ 'affilateblock'];
        }


        elseif($page->template == 'optovikam'){

            $data_mass = [ 'affilateblock'];
        }


        elseif($page->template == 'ceny' || $page->template == 'pay'){

            $prices = DB::table('api_info')->where('name', '=',  "prices")->value('content');
            $prices = json_decode($prices);

            $payments = DB::table('api_info')->where('name', '=',  "payments")->value('content');
            $payments = json_decode($payments);

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

            $countriesData = DB::table('api_info')->where('name', '=',  "countries-data")->value('content');
            $countriesData = json_decode($countriesData);
           
            $data_mass=['countriesData'];
            
        }


        elseif($page->template == 'instruction'){

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

           
            $data_mass=['affilateblock', 'posts'];
        }


        elseif($page->template == 'catalog'){
            
            $allPage = Page::where('page_langs.lang', '=', app()->getLocale())
            ->where('pages.publish','=', '1')
            ->leftJoin('page_langs','pages.id', '=','page_langs.page_id')
            ->get();

            $allPageMetas = Page::where('page_langs.lang', '=', app()->getLocale())
            ->where('pages.publish','=', '1')
            ->leftJoin('page_langs','pages.id', '=','page_langs.page_id')
            ->leftJoin('page_metas','pages.id', '=','page_metas.page_id')
            ->where('page_metas.lang','=',app()->getLocale())
            ->where('page_metas.name','=','ipv_content_top')
            ->select('pages.slug as slug', 'pages.id as id', 'page_langs.title as title', 'page_langs.content as content', 'page_metas.name as name', 'page_metas.content as metacontent')
            ->get();

            $catalogpages = [];
             
            foreach($catalog as $key3 => $cat){
                foreach ($allPage as $key => $value) {
                    if($cat->page == $value->slug){  
                        
                        array_push($catalogpages ,['name'=>$value->title, 'slug'=>$value->slug,  'links'=>[]]);
                        foreach ($cat->links as $element) {
                            foreach ($allPageMetas as $key2 => $value2) {
                                if($value2->slug == $element){
                                    $catalogpages[$key3]['links'][] = ['title'=>$value2->title, 'slug'=>$element, 'img'=>$value2->metacontent];
                                }
                            }
                        }
                        break;
                    }
                }
            }
            
            $data_mass=['affilateblock', 'data_calculator', 'modal_info', 'catalogpages'];
        }



        elseif($page->template == 'podcatalog'){

            $allPageMetas = Page::where('page_langs.lang', '=', app()->getLocale())
            ->where('pages.publish','=', '1')
            ->leftJoin('page_langs','pages.id', '=','page_langs.page_id')
            ->leftJoin('page_metas','pages.id', '=','page_metas.page_id')
            ->where('page_metas.lang','=',app()->getLocale())
            ->where('page_metas.name','=','ipv_content_top')
            ->select('pages.slug as slug', 'pages.id as id', 'page_langs.title as title', 'page_langs.content as content', 'page_metas.name as name', 'page_metas.content as metacontent')
            ->get();

            $catalogpages = [];
             
            foreach($catalog as $key3 => $cat){
                    if($cat->page == $page->slug){  
                        array_push($catalogpages ,['name'=>$page->title, 'slug'=>$page->slug,  'links'=>[]]);
                        foreach ($cat->links as $element) {
                            foreach ($allPageMetas as $key2 => $value2) {
                                if($value2->slug == $element){
                                    $catalogpages[$key3]['links'][] = ['title'=>$value2->title, 'slug'=>$element, 'img'=>$value2->metacontent];
                                }
                            }
                        }
                        break;
                    }
               
            }
            $data_mass=['affilateblock', 'data_calculator', 'modal_info', 'catalogpages'];
        }

        elseif($page->template == 'sitemap'){
            $Posts = Post::query()
            ->where('post_langs.lang', '=', 'ru')
            ->where('posts.publish', '=', '1')
            ->leftJoin('post_langs','posts.id', '=','post_langs.post_id')->get();

            $Pages = Page::where('page_langs.lang','=', app()->getLocale())
            ->where('pages.publish','=', '1')
            ->where('pages.id','!=', $page->page_id)
            ->leftJoin('page_langs','pages.id', '=','page_langs.page_id')->get();

            $data_mass = ['Pages', 'Posts'];
        }


        else{
            $data_mass = [];
        }
        return view("page.index",compact("page" ,"page_metas","menu_top",'socials','course_usd','menu_info','menu_main_bottom','menu_main_country','page_seo','all_payments','menu_main_podmenu','allstats', $data_mass));
    }
}
