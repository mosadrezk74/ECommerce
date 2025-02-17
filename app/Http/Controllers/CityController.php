<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Ship;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer'],
        ]);

        $city = Ship::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return response()->json([
            'city' => $city,
            'message' => 'success'
        ]);
    }
}
