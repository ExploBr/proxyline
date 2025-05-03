<?php

namespace App\Http\Controllers\Admin\Posts;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Page\Service;
use App\Models\Page;

class BaseController 
{

    public $service;
    
    public function __construct(Service $service = null){
        $this->service = $service;  
         
    }

    public function postsCount(){
        return Page::get()->toQuery()->paginate(10);
    }
}
