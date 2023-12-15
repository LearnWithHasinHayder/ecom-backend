<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponController extends Controller
{
    private $coupons = [
        'INVALID'=>[
            'type' => 'percentage',
            'value' => 0,
            'error' => 1,
        ],
        'NEWUSER' => [
            'type' => 'percentage',
            'value' => 10
        ],
        '15OFF'=>[
            'type' => 'percentage',
            'value' => 15
        ],
        '20OFF'=>[
            'type' => 'percentage',
            'value' => 20
        ],
        '30OFF'=>[
            'type' => 'percentage',
            'value' => 20,
            'expired' => 1
        ],
    ];
    function validateCoupon(Request $request){
        //only validate if the user is authenticated
        if(!$request->user()){
            return $this->coupons['INVALID'];
        }

        $coupon = $request->coupon;
        if(array_key_exists($coupon, $this->coupons)){
            return $this->coupons[strtoupper($coupon)];
        }else{
            return $this->coupons['INVALID'];
        }
    }
}
