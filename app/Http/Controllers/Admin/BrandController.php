<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index()
    {
       $brands=Brand::all();
       return view('Admin.Brand.Brand',compact('brands'));
    }


    public function create()
    {
        return view('Admin.Brand.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:brands,name,',

        ]);
        $brands=new Brand();
        $brands->name=$request->name;
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/players/', $filename);
            $brands->image = $filename;
        }
        $brands->status=$request->status;
        $brands->save();
        $request->session()->flash('message');
        return redirect('admin/brand');

    }


    public function delete(Request $request,$id)
    {
        $data=Brand::find($id);
        $data->delete();
        $request->session()->flash('message','Product Brand is successfully deleted');
        return redirect('admin/brand');
    }

    public function status(Request $request,$status,$id)
    {
        $data=Brand::find($id);
        $data->status=$status;
        $data->save();
        $request->session()->flash('message','Product Brand is successfully updated');
        return redirect('admin/brand');
    }

}
