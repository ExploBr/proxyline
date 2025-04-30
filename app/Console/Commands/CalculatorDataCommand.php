<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculatorDataCommand extends Command
{
    
    protected $signature = 'app:CalculatorDataCommand';

   
    protected $description = 'get all data';

    public array $typesList = [
        'dedicated:4',
        'shared:4',
        'dedicated:6',
    ];

    public  array $all_countries = [];
    public  array $data_countries = [];

    public $data_availability;
    public function handle()
    {
       $payment = new ImportDataClient();

       $response_availability = $payment->client->request('GET','/availability-data');
       $this->data_availability = json_decode($response_availability->getBody()->getContents());

       $response_countries = $payment->client->request('GET','/countries');
       $this->all_countries  = json_decode($response_countries->getBody()->getContents());

       $this->countries();

       $response_prices = $payment->client->request('GET','/proxy-prices/?v=3');
       $data_prices = json_decode($response_prices->getBody()->getContents());
        
       $response_limits = $payment->client->request('GET','/order-limits');
       $data_limits =json_decode($response_limits->getBody()->getContents());

       
    
       
        
      $data = [
        'prices'    => $data_prices,
        'countries' => $this->data_countries,
        'limits' => $data_limits,
    ];
     
    // dump( $data);
   
       dump( '______________________________');
      
         $data = json_encode($data, JSON_UNESCAPED_UNICODE);
           
          DB::table('api_info')->updateOrInsert(
          
                ['name' => 'calculator_data'],
                ['name' => 'calculator_data', 'content' => $data],
              
        );    

            
        

    }

     
    public function countries(){

         
            if (!empty($this->all_countries) && !empty($this->typesList)) {

                $availability_countries = $this->data_availability;

                $countries = $this->all_countries;

                if (!empty($countries)) {
                    $countriesList = [];
                    foreach ($countries as $c) {
                         
                        $countriesList[$c->code] = $c;
                    }
                }

                foreach ($this->typesList as $type) {
                    $out = [];
  

                    if (!empty($availability_countries) && !empty($countriesList)) {
                        foreach ($availability_countries as $key => $item) {
                            if (isset($item->{$type}) && $item->{$type} === true) {
                                if (isset($countriesList[$key])  ) {
                                    $out[$key] = $countriesList[$key];
                                }
                            }
                        }
                    }
                
                    if (app()->getLocale() === 'ru') {
                        usort($out, [$this, 'sort_countries_ru']);
                    } else {
                        usort($out, [$this, 'sort_countries']);
                    }

                    $sortArray = [];

                    if (!empty($out))
                        foreach ($out as $item) {
                            $sortArray[$item->code] = $item;
                        }

                    $this->data_countries[$type] = $sortArray;
                     
                }
                 
               
            }
         
        
    }


    private function sort_countries($a, $b) {
        return strcmp($a->name, $b->name);
    }

    private function sort_countries_ru($a, $b) {
        return strcmp($a->name_ru, $b->name_ru);
    }

}
