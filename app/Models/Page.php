<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';
    protected $guarded = [];

    public function getRouteKeyName(){
        return 'slug';
    }

     
    static public function breadcrumbPageTitle($page){
         
        $pagedata = Page::where('page_langs.page_id', '=', $page->id)
        ->where('page_langs.lang','=', app()->getLocale())
        ->leftJoin('page_langs','pages.id', '=','page_langs.page_id')->get();

    
        if(isset($pagedata[0]->title)){
        return $pagedata['0']->title;
        }else
        return $page->slug;
    }

    

}
