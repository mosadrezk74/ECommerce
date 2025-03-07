<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout(Request $request) {
        DB::beginTransaction();
        try {
            $user = auth()->user();
            $cartItems = Cart::with('product')
                ->where('UserID', $user->UserID)
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['message' => 'Cart is empty'], 400);
            }

            $totalAmount = 0;
            foreach ($cartItems as $item) {
                if ($item->product->StockQuantity < $item->Quantity) {
                    throw new \Exception("Insufficient stock for product: {$item->product->ProductName}");
                }
                $totalAmount += $item->product->Price * $item->Quantity;
            }

            $order = Order::create([
                'UserID' => $user->UserID,
                'OrderDate' => now(),
                'TotalAmount' => $totalAmount,
                'Status' => 'Pending',
                'ShippingAddressID' => $request->ShippingAddressID,
                'PaymentMethod' => $request->PaymentMethod
            ]);

            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'OrderID' => $order->OrderID,
                    'ProductID' => $item->ProductID,
                    'Quantity' => $item->Quantity,
                    'Price' => $item->product->Price
                ]);

                Product::where('ProductID', $item->ProductID)
                    ->decrement('StockQuantity', $item->Quantity);
            }

            Cart::where('UserID', $user->UserID)->delete();

            DB::commit();
            return response()->json(['order' => $order, 'message' => 'Order placed successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function index() {
        $orders = Order::where('UserID', auth()->id())
            ->get();
        return response()->json($orders);
    }

    public function show($id) {
        $order = Order::where('UserID', auth()->id())
            ->findOrFail($id);
        return response()->json($order);
    }
}
