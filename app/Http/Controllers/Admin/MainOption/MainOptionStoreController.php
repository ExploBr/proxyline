<?php
 

namespace App\Http\Controllers\Admin\MainOption;


use App\Http\Controllers\Controller;
use App\Http\Requests\MainOption\StoreRequest;
use App\Models\MainOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MainOptionStoreController extends Controller
{
    public function __invoke(StoreRequest $request){
      
        $data = $request->validated();
        
        if(isset($data["logo_image"])){
            foreach($data["logo_image"] as $key => $value){
                $name = $value->getClientOriginalname();

                $filePath = Storage::disk('public')->putFileAs('/images', $value, $name);
                $fileSize = Storage::disk('public')->size($filePath);
                $logo = ['image' => ['path'=>$filePath,'url'=>url('/storage/'.$filePath), 'size' => $fileSize, 'name' => $name]];
                
                MainOption::updateOrCreate(
                    ['name' => 'logo'],
                    [
                    'content' => json_encode($logo, JSON_UNESCAPED_UNICODE),
                    
                    ]
                );
            }
        }
        return response(['message' => 'ok']);
    }
}
