<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function store(Request $request){
        //vcr
        $V_date=$request->validate([
            'merchant_account_id'=>'required',
            'name'=>'required',
            'slug'=>'required',
            'discount_amount'=>'required',
            'expired'=>'required',
        ]);
        $coupon=Coupon::create($V_date);
        return response()->json([
            'coupon'=>$coupon,
            'message'=>'Message Ok'
        ]);
    }
}
