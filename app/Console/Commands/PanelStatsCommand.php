<?php

namespace App\Console\Commands;

use App\Components\StatsData;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PanelStatsCommand extends Command
{
    
    protected $signature = 'app:PanelStatsCommand';

   
    protected $description = 'get stats';

     
    public function handle()
    {
       $payment = new StatsData();
       $response = $payment->client->request('GET','api/web/v1/1/landing/stats');
       $data =$response->getBody()->getContents();
         
       dump($data);
         DB::table('api_info')->upsert(
            [
                ['name' => 'stats', 'content' => $data],
                
            ],
            ['name'],
            ['content']
        );  

            
        

    }
}
