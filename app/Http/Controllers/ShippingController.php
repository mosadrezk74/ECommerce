<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use App\Models\Order;
use App\Models\UserShip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShippingController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user();
            $order = Order::where('UserID', $user->UserID)
                ->where('Status', 'Pending')
                ->firstOrFail();
            $userShip = UserShip::with('city')->where('UserID', $user->UserID)->first();
            if (!$userShip->city) {
                throw new \Exception('City information is missing for this user');
            }
            $ship = Ship::create([
                'OrderID' => $order->OrderID,
                'ShippingMethod' => $request->input('ShippingMethod', 'Cash on Delivery'),
                'TrackingNumber' => 'TRK-' . strtoupper(uniqid($user->UserID . '-')),
                'UserID' => $user->UserID,
                'City' => $userShip->city->City,
                'ShippingCost' => $userShip->city->ShippingCost,
                'ShippedAt' => now()->addHours(48),
                'DeliveredAt' => now()->addHours(72),
            ]);
            $order->update(['Status' => 'Shipped']);
            DB::commit();
            return response()->json([
                'message' => 'Shipping created successfully',
                'ship' => $ship
            ], 201);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Required resource not found',
                'error' => $e->getMessage()
            ], 404);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Shipping creation failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }



}
