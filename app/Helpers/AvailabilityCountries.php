<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class AvailabilityCountries
{

     
    
   public static function get_availability_countries($type = 'shared:4') {
        $out = [];
        $avList = [];
        $countriesList = [];
    
        $availability_countries = self::get_remote_countries();
        $countries = self::get_all_countries();
    
        if($countries && !empty($countries)) {
            foreach ($countries as $c) {
                $countriesList[$c->code] = $c;
            }
        }
    
        if( $availability_countries && !empty($availability_countries) && !empty($countriesList) ) {
            foreach($availability_countries as $key => $item) {
                if( isset( $item->{$type} ) && $item->{$type} === true ) {
                    $avList[] = $key;
                    if( isset($countriesList[$key]) ) {
                        $out[$key] = $countriesList[$key];
                    }
                }
            }
        }
    
        if( app()->getLocale() === 'ru' ) {
            usort($out, 'self::sort_countries_ru');
        } else {
            usort($out, 'self::sort_countries');
        }
    
        $sortArray = [];
    
        if( !empty($out) ) {
            foreach ($out as $item) {
                $sortArray[$item->code] = $item;
            }
        }
    
        return $sortArray;
    }


    public static function get_remote_countries() {
        
        $response = DB::table('api_info')->where('name', '=',  "availability-data")->value('content');
        if(isset($response)){
            $body = json_decode( $response );
            return $body;
        }
 
        return false;
    }


    public static function get_all_countries() {
        $response = DB::table('api_info')->where('name', '=',  "countries-data")->value('content');
        if(isset($response)){
            $body = json_decode( $response );
            return $body;
        }
 
        return false;
    }


    public static function sort_countries($a, $b) {
        return strcmp($a->name, $b->name);
    }
    
    public static function sort_countries_ru($a, $b) {
        return strcmp($a->name_ru, $b->name_ru);
    }

}