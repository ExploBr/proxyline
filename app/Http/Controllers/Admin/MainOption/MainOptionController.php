<?php

namespace App\Http\Controllers\Admin\MainOption;

use App\Http\Controllers\Controller;
use App\Models\MainContentOptions;
use App\Models\MainOption;
use Illuminate\Http\Request;

class MainOptionController extends Controller
{
    
    public function __invoke(){
        
         
        $data = MainOption::where('name', '=', 'logo')
        ->value('content');
    
        $data  = json_decode($data);
       
        return view("admin.mainoption.index" , compact("data"));
    }
}
