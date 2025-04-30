<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CountriesDataCommand extends Command
{
    
    protected $signature = 'app:CountriesDataCommand';

   
    protected $description = 'get Countries Data';

     
    public function handle()
    {
       $payment = new ImportDataClient();
       $response = $payment->client->request('GET','/countries');
        $data = $response->getBody()->getContents();
       
        DB::table('api_info')->upsert(
            [
                ['name' => 'countries-data', 'content' => $data],
                
            ],
            ['name'],
            ['content']
        );

            dump($data);
        

    }
}
