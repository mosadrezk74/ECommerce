<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin\Admin;
use App\Models\Admin\Customer;
use App\Models\Admin\Order;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
class AdminController extends Controller
{
    public function index(Request $request)
    {
      if($request->session()->has('ADMIN_LOGIN')){
          return redirect('admin/dashboard');
      }
      else
      {

        return view('admin.login');
      }

    }
    public function auth(Request $request)
    {
      $email=$request->post('email');
      $password=$request->post('password');

       $result=Admin::where(['email'=>$email])->first();
if($result)
{
  if(Hash::check($request->post('password'),$result->password)){
  $request->session()->put('ADMIN_LOGIN',true);
      $request->session()->put('ADMIN_ID',$result->id);
      return redirect('admin/dashboard');
}
else{

  $request->session()->flash('error','please enter valid login details');
  return redirect('admin');}
}else{

  $request->session()->flash('error','please enter valid login details');
  return redirect('admin');
}

    }

    public function dashboard()
    {
       ##########################################################################################
        $customers=Customer::all()->count('name');
        $acustomers=Customer::where('status','1')->count('name');
        $dcustomers=Customer::where('status','0')->count('name');
        $total=Order::all()->sum('total_amt');
        $placed=Order::where('orders_status','1')->count('orders_status');
        $otway=Order::where('orders_status','2')->count('orders_status');
        $delevered=Order::where('orders_status','3')->count('orders_status');
        $successpayment=Order::where('payment_status','Success')->count('payment_status');
       ##########################################################################################
       $data=compact('customers','acustomers','dcustomers','total','placed','otway','delevered','successpayment');
       ##########################################################################################
        return view('Admin.dashboard')->with($data);
    }
    public function updatepassword()
    {
       $r=Admin::find(1);
       $r->password=Hash::make(12345678);
       $r->save();
    }

}
