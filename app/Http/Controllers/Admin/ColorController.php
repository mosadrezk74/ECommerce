<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        ################################
        $colors=Color::all();
        ################################
       return view('Admin/Color/Color',compact('colors'));
    }

    public function  create()
    {
        return view('Admin/Color/create');
    }


    public function store(Request $request)
    {
     $request->validate([
        //  'name'=>'required',
         'color'=>'required|unique:colors,color,'.$request->post('id'),
     ]);

     $color=new Color();
     $color->color=$request->color;

     $color->save();
     $msg='Color is successfully added';


     $request->session()->flash('message',$msg);
     return redirect('admin/color');
    }


    public function delete(Request $request,$id)
    {
        $data=Color::find($id);
        $data->delete();
        $request->session()->flash('message','Color is successfully deleted');
        return redirect('admin/color');
    }

    public function status(Request $request,$status,$id)
    {
        $data=Color::find($id);
        $data->status=$status;
        $data->save();
        $request->session()->flash('message','Color Status is successfully Updated');
        return redirect('admin/color');


    }

}
