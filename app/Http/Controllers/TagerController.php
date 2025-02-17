<?php

namespace App\Http\Controllers;

use App\Models\Tager;
use Illuminate\Http\Request;

class TagerController extends Controller
{
public function store(Request $request){
    //VCR
    $v_Date=$request->validate(
        [
            'banking_id'=>'required',
            'user_id'=>'required',
            'name'=>'required',
            'slug'=>'required',
            'address'=>'required',
            'bank_account_name'=>'required',
            'bank_account_number'=>'required',
            'image'=>'required',
            'bank_branch_name'=>'required',
            'balance'=>'required',
        ]
        );
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }
        $merchant=Tager::create($v_Date);

        return response()->json(
            [
                'Data'=>$merchant,
                'Message'=>'OK Data'
            ]
        );
}
}
