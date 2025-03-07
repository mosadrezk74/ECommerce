<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        $cat['data']=Tax::all();
       return view('Admin/Tax/Tax',$cat);
    }

    public function  manage_tax(Request $request,$id='')
    {
        if($id>0)
        {
            $arr=Tax::where(['id'=>$id])->get();
            
           
            $result['tax_desc']=$arr['0']->tax_desc;
            $result['tax_value']=$arr['0']->tax_value;
            $result['id']=$arr['0']->id;
        }
        else
        {
           
           
            $result['tax_desc']='';
            $result['tax_value']='';
            $result['id']='0';
        }
      
        return view('Admin/tax/manage_tax',$result);   
    }

   
    public function manage_tax_process(Request $request)
    {
   

     $request->validate([
        
         'tax_value'=>'required|unique:taxes,tax_value,'.$request->post('id'),
     ]);
 
     if($request->post('id')>0)
     {
     $tax=Tax::find($request->post('id'));
     $msg="Tax is Successfully updated";
     }
     else
     {
         $tax=new Tax();
         $msg="Tax is Successfully Inserted";
     }

     $tax->tax_desc=$request->post('tax_desc');
     $tax->tax_value=$request->post('tax_value');
    $tax->status=1;
     $tax->save();
     $request->session()->flash('message',$msg);
     return redirect('admin/tax');
    }

    
    public function delete(Request $request,$id)
    {
        $data=Tax::find($id);
        $data->delete();
        $request->session()->flash('message','Tax is successfully deleted'); 
        return redirect('admin/tax');
    }

    public function status(Request $request,$status,$id)
    {
        $data=Tax::find($id);
        $data->status=$status;
        $data->save();
        $request->session()->flash('message','Tax Status is successfully Updated'); 
        return redirect('admin/tax');

       
    }
}
