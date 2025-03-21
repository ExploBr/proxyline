<?php

declare(strict_types=1);

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use App\Helpers\Langs;

class LangsController
{
    public function __invoke($lang) {
        if(!in_array($lang,Langs::LOCALES)){
            abort(404);
        }

        App::setLocale($lang);  

        $uri = Langs::getUri($lang);

        return redirect($uri);
    }
}
