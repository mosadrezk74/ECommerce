<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

 use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function create(Request $request)
    {
        //vcr
        $v_data=Validator::make($request->all(),[
            'name'=>'required',
        ]);
        if($v_data->fails()){
            return response()->json($v_data->errors(),422);
        }
        $product=Product::create($v_data->validated());
        return response()->json([
            'prod'=>$product,
        ]);
    }
    //register
    //4 errors
    public function register(Request $request){
        //Vcr
        $valid_Data=Validator::make($request->all(),[
            'FirstName'=>'required|string|max:100',
            'LastName'=>'required|string|max:100',
            'Email'=>'required|email|unique:users',
            'PasswordHash'=>'required|string|min:8',
            'PhoneNumber'=>'sometimes|numeric',
        ]);
        if($valid_Data->fails()){
            return response($valid_Data->errors(),422);
        }
        $v_Data=$valid_Data->validated();

        $user=User::create([
            'FirstName'=>$v_Data['FirstName'],
            'LastName'=>$v_Data['LastName'],
            'Email '=>$v_Data['Email'],
            'PasswordHash'=>Hash::make($v_Data['PasswordHash']),
            'PhoneNumber'=>$v_Data['PhoneNumber'],
        ]);

        event(new Registered($user));

        return response()->json([
            'user'=>$user,
            'token'=>$user->createToken('create-token')->plaintextToken
        ]);
    }

    public function AddToCart(Request $request){
        //vaf-cw-csr
        $validation=Validator::make($request->all(),[
            'ProductID'=>'required|exists:products,ProductID',
            'Quantity'=>'required|integer|min:1'
        ]);
        if($validation->fails()){
            return response([
                'message'=>'error',
                'errors'=>$validation->errors()
            ],400);
        }
        $Validated_Data=$validation->validated();
        $user=Auth::user();
        $product=Product::find($Validated_Data['ProductID']);
        $CartItem=Cart::where('ProductID',$request->ProductID)
        ->where('UserID',$user->UserID)->first()
        ;
        if(!$product){
            return response()->json('not found here');
        }
        if($product->StockQuantity < $Validated_Data['Quantity']){
            return response()->json(
                [
                    'message'=>'Out of stock'
                ]
            );
        }

        if($CartItem){
            $CartItem->Quantity+=$Validated_Data['Quantity'];
            $CartItem->Price=$product->Price*$CartItem->Quantity;
            $CartItem->save();
        }else{
            $CartItem=Cart::create([
                'UserID'=>$user->UserID,
                'ProductID'=>$Validated_Data['ProductID'],
                'Quantity'=>$Validated_Data['Quantity'],
                'Price' => $Validated_Data['Quantity'] * $product->Price,

            ]);
            $product->StockQuantity-=$Validated_Data['Quantity'];

            return response()->json([
                'message'=>'ok request',
            ]);
        }

    }


    public function checkout(Request $request){
        DB::beginTransaction();
        try{
            $C_User=Auth::user();
            $CartItem=Cart::with('product')->where('UserID',$C_User->UserID)->get();
            if(!$CartItem){
                return response()->json('notFound');
            }

            $totalPrice=0;
            foreach($CartItem as $item){
                if($item->product->StockQuantity < $request->item){
                    return response()->json('لا يوجد كميه كافيه');
                }
                $totalPrice+=$item->Quantity*$item->product->Price;
            }

            $order=Order::create([
                'UserID'=>$C_User->UserID,
                'Data Created'=>now(),
                'Total Price'=>$totalPrice,
                'ShippingAddressID' => $request->ShippingAddressID,
                'PaymentMethod' => $request->PaymentMethod
            ]);
            foreach($CartItem as $item){
                OrderDetail::create([
                    'OrderID' => $order->OrderID,
                    'ProductID' => $item->ProductID,
                    'Quantity' => $item->Quantity,
                    'Price' => $item->product->Price
                ]);
                Product::where('ProductID',$item->ProductID)
                ->decrement('StockQuantity',$item->Quantity);
            }
            Cart::where('UserID',$C_User->UserID)->delete();
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }


















}
