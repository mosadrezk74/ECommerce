<?php

namespace App\Http\Controllers;
use App\Models\Cart;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addToCart(Request $request) {

        $validation = Validator::make($request->all(), [
            'ProductID' => 'required|exists:products,ProductID',
            'Quantity'  => 'required|integer|min:1'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors'  => $validation->errors(),
            ], 422);
        }

        $validatedData = $validation->validated();

        $user = Auth::user();

        $product = Product::find($validatedData['ProductID']);
        if (!$product) {
            return response()->json(['message' => 'المنتج غير موجود'], 404);
        }

        if ($product->StockQuantity < $validatedData['Quantity']) {
            return response()->json(['message' => 'لا يوجد كمية كافية من هذا المنتج'], 400);
        }

        $cartItem = Cart::where('UserID', $user->UserID)
            ->where('ProductID', $validatedData['ProductID'])
            ->first();

        if ($cartItem) {

            $cartItem->Quantity += $validatedData['Quantity'];
            $cartItem->Price = $cartItem->Quantity * $product->Price;
            $cartItem->save();
        } else {
            $cartItem = Cart::create([
                'UserID' => $user->UserID,
                'ProductID' => $validatedData['ProductID'],
                'Quantity' => $validatedData['Quantity'],
                'Price' => $validatedData['Quantity'] * $product->Price,
            ]);
        }

        // $product->StockQuantity -= $validatedData['Quantity'];
        $product->save();

        return response()->json([
            'message' => 'تمت الإضافة بنجاح',
            'cartItem' => $cartItem,
            // 'remainingStock' => $product->StockQuantity
        ]);
    }



    public function index() {
        $cartItems = Cart::with('product')
            ->where('UserID', auth()->id())
            ->get();
        return response()->json($cartItems);
    }


    public function update(Request $request, $id) {
        $user = auth()->user();
        $validatedData = Validator::make($request->all(), [
            'Quantity' => 'required|integer|min:1'
        ])->validate();

        $cartItem = Cart::where('CartID', $id)
            ->where('UserID', $user->UserID)
            ->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Item not found in cart'], 404);
        }

        $product = Product::where('ProductID', $cartItem->ProductID)->first();
        if ($product->StockQuantity < $validatedData['Quantity']) {
            return response()->json(['message' => 'لا يوجد كمية كافية من هذا المنتج'], 400);
        }

        $cartItem->Quantity = $validatedData['Quantity'];
        $cartItem->Price = $validatedData['Quantity'] * $product->Price;
        $cartItem->save();

        // $product->StockQuantity -= ($validatedData['Quantity'] - $cartItem->Quantity);
        $product->save();

        return response()->json([
            'message' => 'Item updated in cart',
            'cartItem' => $cartItem,
            // 'remainingStock' => $product->StockQuantity
        ]);
    }



    public function destroy($id) {
        Cart::where('CartID', $id)
            ->where('UserID', auth()->id())
            ->delete();
        return response()->json(['message' => 'Item removed from cart']);
    }


}
