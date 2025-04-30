<?php

namespace App\Http\Controllers\Admin\MainContent;

use App\Http\Controllers\Controller;
use App\Models\MainContentOptions;
use Illuminate\Http\Request;

class MainContentController extends Controller
{
    
    public function __invoke(){
        

        $data_advContent = MainContentOptions::where('name', '=', 'advantages')
        ->select(  'content','lang')
        ->get();
    
        $data_advContent = json_decode($data_advContent);


        $data_whereuse = MainContentOptions::where('name', '=', 'whereuse')
        ->select(  'content','lang')
        ->get();
    
        $data_whereuse = json_decode($data_whereuse);

        $data_seo = MainContentOptions::where('name', '=', 'seoblock')
        ->select(  'content','lang')
        ->get();
    
        $data_seo = json_decode($data_seo);

        $data_affilate = MainContentOptions::where('name', '=', 'affilateblock')
        ->select(  'content','lang')
        ->get();
    
        $data_affilate = json_decode($data_affilate);
       
        $data_calculator = MainContentOptions::where('name', '=', 'calculatorblock')
        ->select(  'content','lang')
        ->get();
    
        $data_calculator = json_decode($data_calculator);

        return view("admin.maincontent.index" , compact("data_advContent", "data_whereuse", "data_seo", "data_affilate", "data_calculator"));
    }
}
