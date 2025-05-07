<?php

namespace App\Http\Controllers;

use App\Models\MainContentOptions;
use App\Models\MainOption;
use App\Models\Page;
use App\Models\SeoInfo;
use Illuminate\Database\Eloquent\Builder;
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
    
        $all_payments = json_decode($all_payments);

        
        $socials = MainOption::where('name', '=',  "socials")->value('content');
        $socials = json_decode($socials);

        $course_usd = DB::table('api_info')->where('name', '=',  "course_usd")->value('content');

        $allstats = DB::table('api_info')->where('name', '=',  "stats")->value('content');
        $allstats = json_decode( $allstats);
         



        $catalog = MainOption::where('name', '=', 'catalog')
        ->value('content');
        $catalog  = json_decode( $catalog);

        $allPage = Page::where('page_langs.lang', '=', app()->getLocale())
        ->where('pages.publish','=', '1')
        ->leftJoin('page_langs','pages.id', '=','page_langs.page_id')
        ->get();

        $allPageMetas = Page::where('page_langs.lang', '=', app()->getLocale())
        ->where('pages.publish','=', '1')
        ->leftJoin('page_langs','pages.id', '=','page_langs.page_id')
        ->leftJoin('page_metas','pages.id', '=','page_metas.page_id')
        ->where('page_metas.lang', '=', app()->getLocale())
     
        ->where(function (Builder $query) {
            $query->where('page_metas.name', '=', 'ipv_content_top')
            ->orWhere('page_metas.name','=','code_country')
            ->orWhere('page_metas.name','=','name_country');
        })
        
        ->select('pages.slug','page_langs.title','page_metas.name','page_metas.content')
         ->get();
       


         
        $catalogpages = [];
         
        foreach($catalog as $key3 => $cat){
            foreach ($allPage as $key => $value) {
                if($cat->page == $value->slug){  
                    
                    array_push($catalogpages ,['name'=>$value->title, 'slug'=>$value->slug,  'links'=>[]]);
                    foreach ($cat->links as $element) {
                        $meta = [];
                        $title ='';
                        $slug = '';
                        foreach ($allPageMetas as $key2 => $value2) {
                            if($value2->slug == $element){
                                
                                 $meta[$value2->name] = $value2->content;
                                 $title = $value2->title;
                                 $slug = $value2->slug;
                            }
                        }
                        if($title != ''){
                        $catalogpages[$key3]['links'][] = ['title'=>$title , 'slug'=>$slug, 'meta' => $meta];
                        }
                    }
                    break;
                } 
            }
        }
        
        $countries = MainContentOptions::where('name', '=',  "countries")->value('content');
        $countries = json_decode($countries);
        

        return view("index", 
        compact("page", 'advantages', 'whereuse', 'seoblock',
         'affilateblock', 'data_calculator', 'modal_info', 'reviews_ru', 'reviews_en', 'menu_top',
          'socials', 'course_usd', 'menu_info', 'menu_main_bottom','menu_main_country','all_payments',
          'menu_main_podmenu', 'page_seo', 'allstats','catalogpages', 'countries'));
    }
}
