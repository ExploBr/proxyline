<?php
 

namespace App\Http\Controllers\Admin\MainOption;


use App\Http\Controllers\Controller;
use App\Http\Requests\MainOption\StoreRequest;
use App\Models\MainOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class MainOptionStoreController extends Controller
{
    public function __invoke(StoreRequest $request){
      
        $data = $request->validated();
        // lOGO DATA
        
        if(isset($data["logo_image"])){
            if($data["logo_image"][0] == null){
                MainOption::updateOrCreate(
                    ['name' => 'logo'],
                    [
                    'content' => '',
                    
                    ]
                );
            }else{
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
        }
        // END LOGO

        // METHODS DATA
        if(isset($data["methods_image"])){
                if($data["methods_image"][0] == null){
                    MainOption::updateOrCreate(
                        ['name' => 'methods '],
                        [
                        'content' => '',
                        
                        ]
                    );
                }else{
                foreach($data["methods_image"] as $key => $value){
                    $name = $value->getClientOriginalname();

                    $filePath = Storage::disk('public')->putFileAs('/images', $value, $name);
                    $fileSize = Storage::disk('public')->size($filePath);
                    $methods_image = ['image' => ['path'=>$filePath,'url'=>url('/storage/'.$filePath), 'size' => $fileSize, 'name' => $name]];
                    
                    MainOption::updateOrCreate(
                        ['name' => 'methods'],
                        [
                        'content' => json_encode($methods_image, JSON_UNESCAPED_UNICODE),
                        
                        ]
                    );
                }
            }
        }
        // END METHODS


 
        // REVIEWS_RU DATA
        $reviews_ru_mass = [];
         
        if (isset($data["reviews_ru_sort"])) {
            foreach ($data["reviews_ru_sort"] as $key => $value) {

                if (isset($data["reviews_ru_imageshas"])) {
                    foreach ($data["reviews_ru_imageshas"] as $key2 => $value2) {
                        if ($value['name'] == $value2['name']) {
                            $filePath = $value2['path'];
                            $fileSize = Storage::disk('public')->size($filePath);
                            $my_reviews_ru = ['text' => isset($data["reviews_ru_content"][$value['sort']]) ? $data["reviews_ru_content"][$value['sort']] : '','name' => $data["reviews_ru_name"][$value['sort']], 'image' => ['path' => $filePath, 'url' => url('/storage/' . $filePath), 'size' => $fileSize, 'name' => $value2['name']]];
                            array_push($reviews_ru_mass, $my_reviews_ru);
                            break;
                        }
                    }
                }
                if (isset($data["reviews_ru_images"])) {
                    foreach ($data["reviews_ru_images"] as $key2 => $value2) {
                        $name = $value2->getClientOriginalname();
                        if ($value['name'] == $name) {

                            $filePath = Storage::disk('public')->putFileAs('/images/reviews', $value2, $name);
                            $fileSize = Storage::disk('public')->size($filePath);
                            $my_reviews_ru = ['text' => isset($data["reviews_ru_content"][$value['sort']]) ? $data["reviews_ru_content"][$value['sort']] : '','name' => $data["reviews_ru_name"][$value['sort']],  'image' => ['path' => $filePath, 'url' => url('/storage/' . $filePath), 'size' => $fileSize, 'name' => $name]];

                            array_push($reviews_ru_mass, $my_reviews_ru);
                            break;
                        }
                    }
                }

                if (!isset($data["reviews_ru_images"]) && !isset($data["reviews_ru_imageshas"])) {
                    $my_reviews_ru = ['text' => $data["reviews_ru_content"][$value['sort']],'name' => $data["reviews_ru_name"][$value['sort']], ];

                    array_push($reviews_ru_mass, $my_reviews_ru);
                }
            }


            MainOption::updateOrCreate(
                ['name' => 'reviews_ru'],
                [
                    'content' => json_encode($reviews_ru_mass, JSON_UNESCAPED_UNICODE),            
                ]
            );
        }
 
       

        // END REVIEWS_RU



        // REVIEWS_EN DATA
        $reviews_en_mass = [];
 
        if (isset($data["reviews_en_sort"])) {
            foreach ($data["reviews_en_sort"] as $key => $value) {

                if (isset($data["reviews_en_imageshas"])) {
                    foreach ($data["reviews_en_imageshas"] as $key2 => $value2) {
                        if ($value['name'] == $value2['name']) {
                            $filePath = $value2['path'];
                            $fileSize = Storage::disk('public')->size($filePath);
                            $my_reviews_en = ['text' => isset($data["reviews_en_content"][$value['sort']]) ? $data["reviews_en_content"][$value['sort']] : '','name' => $data["reviews_en_name"][$value['sort']],  'image' => ['path' => $filePath, 'url' => url('/storage/' . $filePath), 'size' => $fileSize, 'name' => $value2['name']]];
                            array_push($reviews_en_mass, $my_reviews_en);
                            break;
                        }
                    }
                }
                if (isset($data["reviews_en_images"])) {
                    foreach ($data["reviews_en_images"] as $key2 => $value2) {
                        $name = $value2->getClientOriginalname();
                        if ($value['name'] == $name) {

                            $filePath = Storage::disk('public')->putFileAs('/images/reviews', $value2, $name);
                            $fileSize = Storage::disk('public')->size($filePath);
                            $my_reviews_en = ['text' => isset($data["reviews_en_content"][$value['sort']]) ? $data["reviews_en_content"][$value['sort']] : '', 'name' => $data["reviews_en_name"][$value['sort']] ,'image' => ['path' => $filePath, 'url' => url('/storage/' . $filePath), 'size' => $fileSize, 'name' => $name]];

                            array_push($reviews_en_mass, $my_reviews_en);
                            break;
                        }
                    }
                }

                if (!isset($data["reviews_en_images"]) && !isset($data["reviews_en_imageshas"])) {
                    $my_reviews_en = ['text' => $data["reviews_en_content"][$value['sort']],'name' => $data["reviews_en_name"][$value['sort']]];

                    array_push($reviews_en_mass, $my_reviews_en);
                }
            }

            MainOption::updateOrCreate(
                ['name' => 'reviews_en'],
                [
                    'content' => json_encode($reviews_en_mass, JSON_UNESCAPED_UNICODE),            
                ]
            );
        }
 
        // END REVIEWS_EN


        // MENU_TOP DATA
        $menu_top = [];
            if (isset($data["menu_top_name"])) {

                foreach ($data["menu_top_name"] as $key => $value) {
                    $menu_top_data = ['name' => $value,'slug' => $data["menu_top_slug"][$key]];

                    array_push($menu_top, $menu_top_data);
                }

                MainOption::updateOrCreate(
                    ['name' => 'menu_top'],
                    [
                        'content' => json_encode($menu_top, JSON_UNESCAPED_UNICODE),            
                    ]
                );

            }
        // END MENU_TOP



        // MENU_INFO DATA
        $menu_info = [];
            if (isset($data["menu_info_name"])) {

                foreach ($data["menu_info_name"] as $key => $value) {
                    $menu_info_data = ['name' => $value,'slug' => $data["menu_info_slug"][$key]];

                    array_push($menu_info, $menu_info_data);
                }

                MainOption::updateOrCreate(
                    ['name' => 'menu_info'],
                    [
                        'content' => json_encode($menu_info, JSON_UNESCAPED_UNICODE),            
                    ]
                );

            }
        // END MENU_INFO
        
        // MENU_MAIN_BOTTOM DATA
        $menu_main_bottom = [];
            if (isset($data["menu_main_bottom_name"])) {

                foreach ($data["menu_main_bottom_name"] as $key => $value) {
                    $menu_main_bottom_data = ['name' => $value,'slug' => $data["menu_main_bottom_slug"][$key]];

                    array_push($menu_main_bottom, $menu_main_bottom_data);
                }

                MainOption::updateOrCreate(
                    ['name' => 'menu_main_bottom'],
                    [
                        'content' => json_encode($menu_main_bottom, JSON_UNESCAPED_UNICODE),            
                    ]
                );

            }
        // END MENU_MAIN_BOTTOM

        // MENU_MAIN_country DATA
        $menu_main_country = [];
            if (isset($data["menu_main_country_name"])) {

                foreach ($data["menu_main_country_name"] as $key => $value) {
                    $menu_main_country_data = ['img' => $data["menu_main_country_img"][$key], 'name' => $value,'slug' => $data["menu_main_country_slug"][$key]];

                    array_push($menu_main_country, $menu_main_country_data);
                }

                MainOption::updateOrCreate(
                    ['name' => 'menu_main_country'],
                    [
                        'content' => json_encode($menu_main_country, JSON_UNESCAPED_UNICODE),            
                    ]
                );

            }
        // END MENU_MAIN_country


        // MENU_MAIN_podmenu DATA
        $menu_main_podmenu = [];
            if (isset($data["podmenu_name"])) {
                $imain = 0;
                $imain2 = 0;
                foreach ($data["podmenu_name"] as $key => $value) {
                    $menu_main_podmenu_data = ['name'=>$value, 'links' =>[]];
                    for ($i=0; $i < $data['podmenu_length'][$imain2]; $i++) { 
                        array_push($menu_main_podmenu_data['links'] , ['img' => $data["menu_main_podmenu_img"][$imain], 'name' => $data["menu_main_podmenu_name"][$imain],'slug' => $data["menu_main_podmenu_slug"][$imain]]);
                        $imain++;
                    }
 
                    array_push($menu_main_podmenu, $menu_main_podmenu_data);
                    $imain2++;
                }

                MainOption::updateOrCreate(
                    ['name' => 'menu_main_podmenu'],
                    [
                        'content' => json_encode($menu_main_podmenu, JSON_UNESCAPED_UNICODE),            
                    ]
                );

            }
        // END MENU_MAIN_podmenu
 

          // socials DATA
          $socials = [];
          if (isset($data["socials_name"])) {

              foreach ($data["socials_name"] as $key => $value) {
                if(isset($data["socials_image"][$key])){
                    $nameImg = $data["socials_image"][$key]->getClientOriginalname();
                    $filePath = Storage::disk('public')->putFileAs('/images/icons', $data["socials_image"][$key], $nameImg);
                    $fileSize = Storage::disk('public')->size($filePath);
                }else{
                    $nameImg = $data["socials_imageName"][$key];    
                    $filePath = $data["socials_imagePath"][$key];
                    $fileSize = $data["socials_imageSize"][$key];
                }
                 
                 

                $socials_data = ['name' => $value,'link' => $data["socials_link"][$key], 'podpis' => $data["socials_podpis"][$key], 'image' => ['path'=>$filePath,'url'=>url('/storage/'.$filePath), 'size' => $fileSize, 'name' => $nameImg]];

                array_push($socials, $socials_data);
              }

              MainOption::updateOrCreate(
                  ['name' => 'socials'],
                  [
                      'content' => json_encode($socials, JSON_UNESCAPED_UNICODE),            
                  ]
              );

          }
      // END socials


        return response(['message' => 'ok']);
    }
}
