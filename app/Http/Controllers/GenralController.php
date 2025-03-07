<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class GenralController extends Controller
{
public function index(){
    return view('index');
}
public function makeSession(Request $request){
    $user=Auth::user();
    session(['UserID' => $user->UserID]);
    session(['UserName' => $user->UserName]);

    return redirect()->route('index');
}







}
