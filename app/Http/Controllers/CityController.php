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
            'City' => ['required', 'string', 'max:255'],
            'Street' => ['required', 'integer'],
            'ShipID' => ['required', 'integer'],
        ]);

        $city = Ship::create([
            'City' => $request->City,
            'Street' => $request->Street,
            'ShipID' => $request->ShipID,
        ]);

        return response()->json([
            'city' => $city,
            'message' => 'success'
        ]);
    }
}
