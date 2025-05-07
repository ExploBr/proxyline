<?php

 

namespace App\Components;

use GuzzleHttp\Client;

class StatsData
{
    public $client;
    public function __construct(){
         

        $this->client = new Client([
            'base_uri' => 'https://webapi.proxyapis.com/',
            'timeout' => 0,
        ]);
    }
}
