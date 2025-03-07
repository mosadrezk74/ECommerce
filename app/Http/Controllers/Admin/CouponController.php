<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons=Coupon::all();
       return view('Admin/Coupon/Coupon',compact('coupons'));
    }

    public function  create()
    {
        $coupons=Coupon::all();
        return view('Admin/Coupon/create' , compact('coupons') );
    }


    public function store(Request $request)
    {


     $request->validate([
         'title'=>'required',
         'code'=>'required|unique:coupons,code,'


     ]);
     $coupon=new Coupon();
     $coupon->title=$request->title;
     $coupon->code=$request->code;
     $coupon->value=$request->value;
     $coupon->status=$request->status;
     $coupon->min_order_amt=$request->min_order_amt;
     $coupon->is_one_time=$request->is_one_time;

     $msg=$request->id>0?'Coupon is successfully updated':'Coupon is successfully created';
     $coupon->save();
     $request->session()->flash('message',$msg);
     return redirect('admin/coupon');
    }


    public function delete(Request $request,$id)
    {
        $data=Coupon::find($id);
        $data->delete();
        $request->session()->flash('message','Coupon is successfully deleted');
        return redirect('admin/coupon');
    }

    public function status(Request $request,$status,$id)
    {
        $data=Coupon::find($id);
        $data->status=$status;
        $data->save();
        $request->session()->flash('message','Coupon is successfully updated');
        return redirect('admin/coupon');
    }


}
