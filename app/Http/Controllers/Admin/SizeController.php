<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
   
    public function index()
    {
        $cat['data']=Size::all();
       return view('Admin/Size/Size',$cat);
    }

    public function  manage_size(Request $request,$id='')
    {
        if($id>0)
        {
            $arr=Size::where(['id'=>$id])->get();
            
           
            $result['size']=$arr['0']->size;
            $result['id']=$arr['0']->id;
        }
        else
        {
           
            $result['size']='';
            $result['id']='0';
        }
      
        return view('Admin/size/manage_size',$result);   
    }

   
    public function manage_size_process(Request $request)
    {
   

     $request->validate([
         'size'=>'required',
        //  'category_slug'=>'required|unique:categories,category_slug,'.$request->post('id'),
     ]);
 
     if($request->post('id')>0)
     {
     $cat=Size::find($request->post('id'));
     $msg="Size is Successfully updated";
     }
     else
     {
         $cat=new Size();
         $msg="Size is Successfully Inserted";
     }

     $cat->size=$request->post('size');
     $cat->status=1;
     $cat->save();
     $request->session()->flash('message',$msg);
     return redirect('admin/size');
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
        $data=Size::find($id);
        $data->status=$status;
        $data->save();
        $request->session()->flash('message','Size Status is successfully Updated'); 
        return redirect('admin/size');

       
    }
}
