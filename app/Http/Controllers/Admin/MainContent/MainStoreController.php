<?php

namespace App\Http\Controllers\Admin\MainContent;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainContent\StoreRequest;
use App\Models\MainContentOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\DomCreate;
use App\Helpers\Langs;

class MainStoreController extends Controller
{

    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $languages = Langs::LOCALES;

        $adv_images = isset($data["adv_images"]) ? $data["adv_images"] : null;
        $adv_imageshas = isset($data["adv_imageshas"]) ? $data["adv_imageshas"] : null;
        $adv_sort = isset($data["adv_sort"]) ? $data["adv_sort"] : null;
        $adv_content = $data["adv_content"];
        unset($data["adv_images"]);
        unset($data["adv_content"]);
        unset($data["adv_imageshas"]);
        unset($data["adv_sort"]);
        $adv_mass = [];

        $whereuse_imageshas = isset($data["whereuse_imageshas"]) ? $data["whereuse_imageshas"] : null;
        $whereuse_image = isset($data["whereuse_image"]) ? $data["whereuse_image"] : null;
        $whereuse_content = isset($data["whereuse_content"]) ? $data["whereuse_content"] : null;
        unset($data["whereuse_imageshas"]);
        unset($data["whereuse_image"]);
        unset($data["whereuse_content"]);


        $seo_content = isset($data['seoblock_content']) ? $data["seoblock_content"] : null;
        $affilate_content = isset($data['affilateblock_content']) ? $data["affilateblock_content"] : null;
        $calculator_content = isset($data['calculatorblock_content']) ? $data["calculatorblock_content"] : null;
        if ($data['lang'] != 'all') {

            // ADVANTAGES SAVE
            if ($adv_sort != null) {
                foreach ($adv_sort as $key => $value) {

                    if ($adv_imageshas != null) {
                        foreach ($adv_imageshas as $key2 => $value2) {
                            if ($value['name'] == $value2['name']) {
                                $filePath = $value2['path'];
                                $fileSize = Storage::disk('public')->size($filePath);
                                $my_adv = ['content' => isset($adv_content[$value['sort']]) ? $adv_content[$value['sort']] : '', 'image' => ['path' => $filePath, 'url' => url('/storage/' . $filePath), 'size' => $fileSize, 'name' => $value2['name']]];
                                array_push($adv_mass, $my_adv);
                                break;
                            }
                        }
                    }
                    if ($adv_images != null) {
                        foreach ($adv_images as $key2 => $value2) {
                            $name = $value2->getClientOriginalname();
                            if ($value['name'] == $name) {

                                $filePath = Storage::disk('public')->putFileAs('/images/prim', $value2, $name);
                                $fileSize = Storage::disk('public')->size($filePath);
                                $my_adv = ['content' => isset($adv_content[$value['sort']]) ? $adv_content[$value['sort']] : '', 'image' => ['path' => $filePath, 'url' => url('/storage/' . $filePath), 'size' => $fileSize, 'name' => $name]];

                                array_push($adv_mass, $my_adv);
                                break;
                            }
                        }
                    }

                    if ($adv_images == null && $adv_imageshas == null) {
                        $my_adv = ['content' => $adv_content[$value['sort']]];

                        array_push($adv_mass, $my_adv);
                    }
                }
            }

            MainContentOptions::updateOrCreate(
                ['name' => 'advantages', 'lang' => $data['lang']],
                [
                    'content' => json_encode($adv_mass, JSON_UNESCAPED_UNICODE),
                    'lang' => $data['lang']
                ]
            );
            // END ADVANTAGES


            // WHEREUSE SAVE
            if ($whereuse_image != null || $whereuse_content != null) {
                if ($whereuse_image != null) {
                    foreach ($whereuse_image as $key => $value) {
                        $name = $value->getClientOriginalname();
                        $filePath = Storage::disk('public')->putFileAs('/images/whereuse', $value, $name);
                        $fileSize = Storage::disk('public')->size($filePath);

                        $content = DomCreate::createDom($whereuse_content[0]);
                        $my_whereuse = ['content' => $content, 'image' => ['path' => $filePath, 'url' => url('/storage/' . $filePath), 'size' => $fileSize, 'name' => $name]];

                        break;
                    }
                }
                if ($whereuse_imageshas != null) {
                    foreach ($whereuse_imageshas as $key2 => $value2) {

                        $filePath = $value2['path'];
                        $fileSize = Storage::disk('public')->size($filePath);

                        $content = DomCreate::createDom($whereuse_content[0]);
                        $my_whereuse = ['content' => $content, 'image' => ['path' => $filePath, 'url' => url('/storage/' . $filePath), 'size' => $fileSize, 'name' => $value2['name']]];

                        break;
                    }
                }

                if ($whereuse_imageshas == null && $whereuse_image == null) {

                    $content = DomCreate::createDom($whereuse_content[0]);
                    $my_whereuse = ['content' => $content];
                }

                MainContentOptions::updateOrCreate(
                    ['name' => 'whereuse', 'lang' => $data['lang']],
                    [
                        'content' => json_encode($my_whereuse, JSON_UNESCAPED_UNICODE),
                        'lang' => $data['lang']
                    ]
                );
            }
            // END WHEREUSE



            // SEO SAVE
            if($seo_content != null){
                $content = DomCreate::createDom($seo_content[0]);
                $my_seoblock =  $content;

                MainContentOptions::updateOrCreate(
                    ['name' => 'seoblock', 'lang' => $data['lang']],
                    [
                        'content' => $my_seoblock,
                        'lang' => $data['lang']
                    ]
                );
            }
            // END SEO


            // PARTNER SAVE

            if($affilate_content != null){
                $content = DomCreate::createDom($affilate_content[0]);
                $my_affilateblock =  $content;

                MainContentOptions::updateOrCreate(
                    ['name' => 'affilateblock', 'lang' => $data['lang']],
                    [
                        'content' => $my_affilateblock,
                        'lang' => $data['lang']
                    ]
                );
            }

            // END PARTNER

            // CALCULATOR START

            if($calculator_content!= null){
              
                foreach ($calculator_content as $key => $value) {
                    $data_calculator[] = ['popup' => $value];
                }
                MainContentOptions::updateOrCreate(
                    ['name' => 'calculatorblock', 'lang' => $data['lang']],
                    [
                        'content' => json_encode($data_calculator, JSON_UNESCAPED_UNICODE),
                        'lang' => $data['lang']
                    ]
                );
            }

            // END CALCULATOR

        } else {
            foreach ($languages as $language) {

                if($language == 'en'){
                    $translatelang = 'English';
                }else if($language == 'fr'){
                    $translatelang = 'French';
                }else if($language == 'de'){
                    $translatelang = 'Deutsch';
                }else if($language == 'ze'){
                    $translatelang = 'Chinese';
                }
                else if($language == 'hi'){
                    $translatelang = 'Hindi';
                }
                else if($language == 'es'){
                    $translatelang = 'Spanish';
                }
                else if($language == 'pt'){
                    $translatelang = 'Portuguese';
                }
                else if($language == 'uk'){
                    $translatelang = 'Ukrainian';
                }
                else if($language == 'be'){
                    $translatelang = 'Belarusian';
                }
                else if($language == 'lt'){
                    $translatelang = 'Lithuanian';
                }
                else if($language == 'lv'){
                    $translatelang = 'Latvian';
                }
                else if($language == 'pl'){
                    $translatelang = 'Poland';
                }
                else if($language == 'cs'){
                    $translatelang = 'Czech';
                }
                else if($language == 'az'){
                    $translatelang = 'Azerbaijan';
                }
                else if($language == 'et'){
                    $translatelang = 'Estonian';
                }
                else if($language == 'ro'){
                    $translatelang = 'Romanian';
                }
                else if($language == 'kk'){
                    $translatelang = 'Kazakh';
                }
                else if($language == 'it'){
                    $translatelang = 'Italian';
                }
                else if($language == 'nl'){
                    $translatelang = 'Dutch';
                }
                else if($language == 'tr'){
                    $translatelang = 'Turkish';
                }
                else if($language == 'id'){
                    $translatelang = 'Indonesia';
                }
                
                // ADVANTAGES SAVE
                if ($adv_sort != null) {
                    foreach ($adv_sort as $key => $value) {

                        if ($adv_imageshas != null) {
                            foreach ($adv_imageshas as $key2 => $value2) {
                                if ($value['name'] == $value2['name']) {
                                    $filePath = $value2['path'];
                                    $fileSize = Storage::disk('public')->size($filePath);
                                    //if(isset($adv_content[$value['sort']]) && $language != 'ru'){
                                    // $content = $adv_content[$value['sort']];
                                    // $result1 = $this->openAIService->translate($content, $translatelang);
                                    //  $newContent =   $result1[0]['content'];
                                    //}else{ $content = ''}

                                    $my_adv = ['content' => isset($adv_content[$value['sort']]) ? $adv_content[$value['sort']] : '', 'image' => ['path' => $filePath, 'url' => url('/storage/' . $filePath), 'size' => $fileSize, 'name' => $value2['name']]];
                                    array_push($adv_mass, $my_adv);
                                    break;
                                }
                            }
                        }
                        if ($adv_images != null) {
                            foreach ($adv_images as $key2 => $value2) {
                                $name = $value2->getClientOriginalname();
                                if ($value['name'] == $name) {

                                    $filePath = Storage::disk('public')->putFileAs('/images/prim', $value2, $name);
                                    $fileSize = Storage::disk('public')->size($filePath);
                                    //if(isset($adv_content[$value['sort']]) && $language != 'ru){
                                    // $content = $adv_content[$value['sort']];
                                    // $result1 = $this->openAIService->translate($content, $translatelang);
                                    //  $newContent =   $result1[0]['content'];
                                    //}else{ $content = ''}
                                    $my_adv = ['content' => isset($adv_content[$value['sort']]) ? $adv_content[$value['sort']] : '', 'image' => ['path' => $filePath, 'url' => url('/storage/' . $filePath), 'size' => $fileSize, 'name' => $name]];

                                    array_push($adv_mass, $my_adv);
                                    break;
                                }
                            }
                        }

                        if ($adv_images == null && $adv_imageshas == null) {


                            // $result1 = $this->openAIService->translate($adv_content[$value['sort']], $translatelang);
                            //  $newContent =   $result1[0]['content'];
                            $my_adv = ['content' => $adv_content[$value['sort']]];
                            array_push($adv_mass, $my_adv);
                        }
                    }
                }

                MainContentOptions::updateOrCreate(
                    ['name' => 'advantages', 'lang' => $language],
                    [
                        'content' => json_encode($adv_mass, JSON_UNESCAPED_UNICODE),
                        'lang' => $language
                    ]
                );
                // END ADVANTAGES 


                // WHEREUSE SAVE
                if ($whereuse_image != null || $whereuse_content != null) {
                    if ($whereuse_image != null) {
                        foreach ($whereuse_image as $key => $value) {
                            $name = $value->getClientOriginalname();


                            $filePath = Storage::disk('public')->putFileAs('/images/whereuse', $value, $name);
                            $fileSize = Storage::disk('public')->size($filePath);



                            $content = DomCreate::createDom($whereuse_content[0]);
                            $my_whereuse = ['content' => $content, 'image' => ['path' => $filePath, 'url' => url('/storage/' . $filePath), 'size' => $fileSize, 'name' => $name]];

                            break;
                        }
                    }
                    if ($whereuse_imageshas != null) {
                        foreach ($whereuse_imageshas as $key2 => $value2) {

                            $filePath = $value2['path'];
                            $fileSize = Storage::disk('public')->size($filePath);

                            $content = DomCreate::createDom($whereuse_content[0]);
                            $my_whereuse = ['content' => $content, 'image' => ['path' => $filePath, 'url' => url('/storage/' . $filePath), 'size' => $fileSize, 'name' => $value2['name']]];

                            break;
                        }
                    }

                    if ($whereuse_imageshas == null && $whereuse_image == null) {

                        $content = DomCreate::createDom($whereuse_content[0]);
                        $my_whereuse = ['content' => $content];
                    }

                    MainContentOptions::updateOrCreate(
                        ['name' => 'whereuse', 'lang' => $language],
                        [
                            'content' => json_encode($my_whereuse, JSON_UNESCAPED_UNICODE),
                            'lang' => $language
                        ]
                    );
                }

                // END WHEREUSE


                // SEO SAVE
                if($seo_content != null){
                    $content = DomCreate::createDom($seo_content[0]);
                    $my_seoblock = ['content' => $content];
    
                    MainContentOptions::updateOrCreate(
                        ['name' => 'seoblock', 'lang' => $language],
                        [
                            'content' => $my_seoblock,
                            'lang' => $language
                        ]
                    );
                }
                // SEO END
                
                // PARTNER SAVE

                    if($affilate_content != null){
                        $content = DomCreate::createDom($affilate_content[0]);
                        $my_affilateblock =  $content;

                        MainContentOptions::updateOrCreate(
                            ['name' => 'affilateblock', 'lang' => $language],
                            [
                                'content' => $my_affilateblock,
                                'lang' => $language
                            ]
                        );
                    }

                // END PARTNER


                 // CALCULATOR START

            if($calculator_content!= null){
              
                foreach ($calculator_content as $key => $value) {
                    $data_calculator[] = ['popup' => $value];
                }
                MainContentOptions::updateOrCreate(
                    ['name' => 'calculatorblock', 'lang' => $language],
                    [
                        'content' => json_encode($data_calculator, JSON_UNESCAPED_UNICODE),
                        'lang' => $language
                    ]
                );
            }

            // END CALCULATOR
            }
        }

        return response(['message' => 'ok']);
    }
}
