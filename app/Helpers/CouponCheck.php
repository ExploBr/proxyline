<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Components\ImportDataClient;
use App\Http\Requests\CouponRequest;
use App\Http\Requests\MainContent\StoreRequest;

class CouponCheck
{

    public function __invoke(CouponRequest $request ){
    
        $coupon = $request->validated();
       
        $client = new ImportDataClient();

        $getCoupon = $client->client->request('GET','/get-coupon-data/' . $coupon['coupon'].'');
        return json_decode( $getCoupon->getBody()->getContents());
    }
}