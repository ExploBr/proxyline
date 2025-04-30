<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AvailabilityDataCommand extends Command
{
    
    protected $signature = 'app:AvailabilityDataCommand';

   
    protected $description = 'get Availability Data';

     
    public function handle()
    {
       $payment = new ImportDataClient();
       $response = $payment->client->request('GET','/availability-data');
        $data = $response->getBody()->getContents();
       
        DB::table('api_info')->upsert(
            [
                ['name' => 'availability-data', 'content' => $data],
                
            ],
            ['name'],
            ['content']
        );

            dump($data);
        

    }
}
