<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PanelStatsCommand extends Command
{
    
    protected $signature = 'app:PanelStatsCommand';

   
    protected $description = 'get stats';

     
    public function handle()
    {
       $payment = new ImportDataClient();
       $response = $payment->client->request('GET','/stats');
       $data =$response->getBody()->getContents();
         
       dump($data);
       /* DB::table('api_info')->upsert(
            [
                ['name' => 'stats', 'content' => $data],
                
            ],
            ['name'],
            ['content']
        ); */

            
        

    }
}
