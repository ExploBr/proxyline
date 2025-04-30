<?php

namespace App\Console\Commands;

use App\Components\CourseData;
 

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CourseCommand extends Command
{
    
    protected $signature = 'app:CourseCommand';

   
    protected $description = 'get course';

     
    public function handle()
    {
       $payment = new CourseData();
       $response = $payment->data->request('GET','/daily_json.js');
       $data =$response->getBody()->getContents();
       $data = json_decode($data);
       if(isset($data->Valute->USD->Value)){

            dump($data->Valute->USD->Value);

          DB::table('api_info')->upsert(
                [
                    ['name' => 'course_usd', 'content' => $data->Valute->USD->Value],
                    
                ],
                ['name'],
                ['content']
            ); 
       }
        

            
        

    }
}
