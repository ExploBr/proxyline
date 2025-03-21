<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexPostController extends Controller
{
    public function __invoke(Request $request){
        $persons = [
            [
                'name' => 'art',
                'age'=>20
            ],
            [
                'name' => 'art2',
                'age'=>22
            ],
            [
                'name' => 'art3',
                'age'=>23
            ]
            ];

       // return view("post.index");
       return $persons;
    }
}
