<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class GenralController extends Controller
{
    public function create_bank(Request $request){
        //vcr
        $V_Data=$request->validate(
            [
                'name'=>'required',
                'alias'=>'required',
            ]
        );
        $Bank=Bank::create($V_Data);
        return response()->json([
            'Bank'=>$Bank,
            'Message'=>'Ok',
        ]);
    }
}
