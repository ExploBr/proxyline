<?php

namespace App\Http\Controllers\Admin\MainOption;

use App\Http\Controllers\Controller;
use App\Models\MainContentOptions;
use App\Models\MainOption;
use App\Models\Page;
use Illuminate\Http\Request;

class MainOptionController extends Controller
{
    
    public function __invoke(){
        
         
        $data = MainOption::where('name', '=', 'logo')
        ->value('content');
    
        $data  = json_decode($data);


        $data_methods = MainOption::where('name', '=', 'methods')
        ->value('content');
    
        $data_methods  = json_decode($data_methods);


        $data_reviews_ru = MainOption::where('name', '=', 'reviews_ru')
        ->value('content');
    
         $data_reviews_ru  = json_decode($data_reviews_ru);


        $data_reviews_en = MainOption::where('name', '=', 'reviews_en')
        ->value('content');
    
        $data_reviews_en  = json_decode($data_reviews_en);
        

        $socials = MainOption::where('name', '=', 'socials')
        ->value('content');
    
        $socials  = json_decode($socials);



        $all_page = Page::all();

        $menu_top = MainOption::where('name', '=', 'menu_top')
        ->value('content');
    
        $menu_top  = json_decode($menu_top);
        
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
         
       
        return view("admin.mainoption.index" , compact("data", "data_methods","data_reviews_ru","data_reviews_en", 'all_page', 'menu_top','socials', 'menu_info', 'menu_main_bottom', 'menu_main_country', 'menu_main_podmenu'));
    }
}
