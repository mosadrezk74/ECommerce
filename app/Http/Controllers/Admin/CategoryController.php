<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class CategoryController extends Controller
{

    public function index()
    {

        $categories=Category::all();
        return view('Admin/Category/Category',compact('categories'));

    }
    public function create(){

        $categories=Category::all();
        return view('Admin/Category/create',compact('categories'));

    }

    public function store(Request $request){

        $categories = new Category();
        $categories->category_name = strip_tags($request->category_name);
        $categories->category_desc = strip_tags($request->category_desc);
        $categories->save();
        $request->session()->flash('message','Category is successfully added');
        return redirect('admin/category');
    }


    public function delete(Request $request,$id)
    {
        $data=Category::find($id);
        $data->delete();
        $request->session()->flash('message','Category is successfully deleted');
        return redirect('admin/category');
    }

    public function status(Request $request,$status,$id)
    {
        $data=Category::find($id);
        $data->status=$status;
        $data->save();
        $request->session()->flash('message','Category Status is successfully Updated');
        return redirect('admin/category');


    }


}
