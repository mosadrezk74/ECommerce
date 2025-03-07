<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $cus['data']=Customer::all();
       return view('Admin/Customer/Customer',$cus);
    }

    public function  show(Request $request,$id='')
    {
    
           $arr=Customer::where(['id'=>$id])->get();
            $result['customer_list']=$arr['0'];
            // echo"<pre>";
            // print_r($result['customer_list']);
            // die();
        return view('admin/Customer/show_customer',$result);   
    }

   
    public function manage_customer_process(Request $request)
    {
   

     $request->validate([
         'size'=>'required',
        //  'category_slug'=>'required|unique:categories,category_slug,'.$request->post('id'),
     ]);
 
     if($request->post('id')>0)
     {
     $cus=Customer::find($request->post('id'));
     $msg="Customer is Successfully updated";
     }
     else
     {
         $cus=new Customer();
         $msg="Customer is Successfully Inserted";
     }

     $cus->size=$request->post('size');
     $cus->status=1;
     $cus->save();
     $request->session()->flash('message',$msg);
     return redirect('admin/cus');
    }

    
    public function delete(Request $request,$id)
    {
        $data=Size::find($id);
        $data->delete();
        $request->session()->flash('message','Size is successfully deleted'); 
        return redirect('admin/size');
    }

    public function status(Request $request,$status,$id)
    {
        $data=Customer::find($id);
        $data->status=$status;
        $data->save();
        $request->session()->flash('message','Customer Status is successfully Updated'); 
        return redirect('admin/customer');

       
    }
}
