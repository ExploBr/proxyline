<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PanelPaymentMethodsCommand extends Command
{
    
    protected $signature = 'app:paymentMethodsCommand';

   
    protected $description = 'get payment methods';

     
    public function handle()
    {
       $payment = new ImportDataClient();
       $response = $payment->client->request('GET','/payment-methods');
        $data =$response->getBody()->getContents();
         
        DB::table('api_info')->upsert(
            [
                ['name' => 'payments', 'content' => $data],
                
            ],
            ['name'],
            ['content']
        );

            dump($data);
        

    }
}
