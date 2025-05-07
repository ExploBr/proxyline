<?php
 

namespace App\Http\Controllers\Admin\Catalog;


use App\Http\Controllers\Controller;
use App\Http\Requests\MainOption\StoreRequest;
use App\Models\MainOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class CatalogStoreController extends Controller
{
    public function __invoke(StoreRequest $request){
        $data = $request->validated();

        MainOption::updateOrCreate(
            ['name' => 'catalog'],
            [
                'content' => json_encode($data['catalog'], JSON_UNESCAPED_UNICODE),            
            ]
        );
        return response(['message' => 'ok']);

    }

}