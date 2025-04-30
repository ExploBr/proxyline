<?php

 

namespace App\Components;

use GuzzleHttp\Client;

class CourseData
{
    public $data;
    public function __construct(){
         

        $this->data = new Client([
            'base_uri' => 'https://www.cbr-xml-daily.ru',
            'timeout' => 0,
        ]);
    }
}
