<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use App\Models\MainOption;
use App\Models\Page;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    
    public function __invoke(){
        
        $all_page = Page::all();
        $catalog = MainOption::where('name', '=', 'catalog')
        ->value('content');
        $catalog = json_decode($catalog);
        return view("admin.catalog", compact('all_page', 'catalog'));
    }
}
