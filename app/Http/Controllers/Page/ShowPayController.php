<?php

namespace App\Http\Controllers\Page;

use App\Helpers\AvailabilityCountries;
use App\Models\MainContentOptions;
use App\Models\MainOption;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\PayRequest;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Route;

class ShowPayController extends Controller
{
    public function __invoke(PayRequest $request){
        $data = $request->validated();
        
        $page = Page::where('pages.id', '=', 17)
        ->where('page_langs.lang','=', app()->getLocale())
        ->leftJoin('page_langs','pages.id', '=','page_langs.page_id')->firstOr(function () {
            abort(404);
        });
        session(['data' => $data]);
        return redirect(route('page.show',$page));
        //return view("page.index",compact("page" ,"page_metas","menu_top",'socials','course_usd', 'data', 'countries_list', 'data_calculator' , 'payments'));
    }
}