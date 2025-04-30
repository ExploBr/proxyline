<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PriceDataCommand extends Command
{
    
    protected $signature = 'app:PriceDataCommand';

   
    protected $description = 'get prices';

     
    public function handle()
    {
       $payment = new ImportDataClient();
       $response = $payment->client->request('GET','/proxy-prices/?v=3');
        $data =$response->getBody()->getContents();
       
        DB::table('api_info')->upsert(
            [
                ['name' => 'prices', 'content' => $data],
                
            ],
            ['name'],
            ['content']
        );

            dump($data);
        

    }
}
