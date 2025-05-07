<?php

namespace App\Http\Controllers\Admin\Countries;

use App\Http\Controllers\Controller;
use App\Models\MainContentOptions;
use App\Models\Page;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    
    public function __invoke(){
 
        $country = MainContentOptions::where('name', '=', 'countries')
        ->select('content','lang')->get();
        
        $country = json_decode($country);
        $newCountry = [];
        foreach($country as $item){
            $content = json_decode($item->content);
            $newCountry[] = ['country' => $content, 'lang' => $item->lang];
        }
        return view("admin.country", compact('newCountry'));
    }
}
