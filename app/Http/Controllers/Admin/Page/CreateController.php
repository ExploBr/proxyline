<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke(Page $page){

      
         
        return view("admin.page.create" , compact(  "page"));
     
      }
}
