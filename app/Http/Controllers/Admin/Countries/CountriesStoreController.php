<?php
 

namespace App\Http\Controllers\Admin\Countries;

use App\Helpers\DomCreate;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainContent\StoreRequest;
use App\Models\MainContentOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class CountriesStoreController extends Controller
{
    public function __invoke(StoreRequest $request){
        $data = $request->validated();
         
        $datamass = [];
        foreach ($data['countries'] as $key => $value) {
          if($key == 'country'){
                foreach ($value as $key => $value2) {
                    $content = DomCreate::createDom($value2['content']);
                    $datamass[] = ['code'=>$value2['code'], 'content'=>$content];
                }
          }
          $lang = $data['countries']['lang'];
        }
       
        MainContentOptions::updateOrCreate(
            ['name' => 'countries'],
            [
                'content' => json_encode($datamass, JSON_UNESCAPED_UNICODE),   
                'lang'=>$lang         
            ]
        );
        return response(['message' => 'ok']);

    }

}