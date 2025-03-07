<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreReq;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class FrontController extends Controller
{
    public function shop(){
        $products = Product::with('category')->paginate(10);
        $categories=Category::all();

        return view('Website.shop'
            ,compact('products' ,'categories'
            )

        );
    }

    public function index(Request $request)
    {
        $products=Product::with('category')->paginate(10);
        $categories = Category::all()->where(['status' => 1]);
        $brands= Brand::all()->where(['status' => 1]);
        $latest_products = Product::with('category')->latest()->limit(9)->get();

        return view('Website.index'
        ,compact('products' ,'categories'
                ,'brands'
                ,'latest_products'

            )

        );

    }


    public function show_product($id){

        $product = Product::with('category' )->paginate(10)->find($id);
        $categories = Category::all();
        return view('Website.details' ,compact('product' , 'categories'));
    }



    public function send(){
        $basic  = new \Vonage\Client\Credentials\Basic("bd9ac08c", "JuLAmGim7Ak9rZbA");
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("201001806482", 'Api', 'alsalam alekom w rahmat allah w barakato ,, a7la mesa 3leek ya dawoly')
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }
    }







    public function category(Request $request,$slug)
    {

            $sort="";
            $sort_txt="";
            $filter_price_start="";
            $filter_price_end="";
            $color_filter="";
            $colorFilterArr=[];
            if($request->get('sort')!==null){
                $sort=$request->get('sort');
            }

            $query=DB::table('products');
            $query=$query->leftJoin('categories','categories.id','=','products.category_id');
            $query=$query->leftJoin('products_attr','products.id','=','products_attr.products_id');
            $query=$query->where(['products.status'=>1]);
            $query=$query->where(['categories.category_slug'=>$slug]);
            if($sort=='name'){
                $query=$query->orderBy('products.name','asc');
                $sort_txt="Product Name";
            }
            if($sort=='date'){
                $query=$query->orderBy('products.id','desc');
                $sort_txt="Date";
            }
            if($sort=='price_desc'){
                $query=$query->orderBy('products_attr.price','desc');
                $sort_txt="Price - DESC";
            }if($sort=='price_asc'){
                $query=$query->orderBy('products_attr.price','asc');
                $sort_txt="Price - ASC";
            }
            if($request->get('filter_price_start')!==null && $request->get('filter_price_end')!==null){
                $filter_price_start=$request->get('filter_price_start');
                $filter_price_end=$request->get('filter_price_end');

                if($filter_price_start>0 && $filter_price_end>0){
                    $query=$query->whereBetween('products_attr.price',[$filter_price_start,$filter_price_end]);
                }
            }

            if($request->get('color_filter')!==null){
                $color_filter=$request->get('color_filter');
                $colorFilterArr=explode(":",$color_filter);
                $colorFilterArr=array_filter($colorFilterArr);

                $query=$query->where(['products_attr.color_id'=>$request->get('color_filter')]);

            }

            $query=$query->distinct()->select('products.*');
            $query=$query->get();
            $result['product']=$query;

            foreach($result['product'] as $list1){

                $query1=DB::table('products_attr');
                $query1=$query1->leftJoin('sizes','sizes.id','=','products_attr.size_id');
                $query1=$query1->leftJoin('colors','colors.id','=','products_attr.color_id');
                $query1=$query1->where(['products_attr.products_id'=>$list1->id]);
                $query1=$query1->get();
                $result['product_attr'][$list1->id]=$query1;
            }

            $result['colors']=DB::table('colors')
            ->where(['status'=>1])
            ->get();


            $result['categories_left']=DB::table('categories')
            ->where(['status'=>1])
            ->get();

            $result['slug']=$slug;
            $result['sort']=$sort;
            $result['sort_txt']=$sort_txt;
            $result['filter_price_start']=$filter_price_start;
            $result['filter_price_end']=$filter_price_end;
            $result['color_filter']=$color_filter;
            $result['colorFilterArr']=$colorFilterArr;


        return view('Frontend.Product.category',$result);
}


// Registration Controller


             public function email_verification(Request $request,$id)
             {

        $result=DB::table('customers')
        ->where(['rand_id'=>$id])
        ->where(['is_verify'=>0])
        ->get();

    if(isset($result[0])){
        DB::table('customers')
        ->where(['id'=>$result[0]->id])
        ->update(['is_verify'=>1,'rand_id'=>'']);
        return view('Frontend.Product.verification');
    }
    else
    {
        return redirect('/');
    }
             }



        // Forgot password    //

        public function forgot_password(Request $request)
        {

            $result=DB::table('customers')
                ->where(['email'=>$request->str_forgot_email])
                ->get();
            $rand_id=rand(111111111,999999999);
            if(isset($result[0])){

                DB::table('customers')
                    ->where(['email'=>$request->str_forgot_email])
                    ->update(['is_forgot_password'=>1,'rand_id'=>$rand_id]);

                $data=['name'=>$result[0]->name,'rand_id'=>$rand_id];
                $user['to']=$request->str_forgot_email;
                Mail::send('Frontend.Product.forgot_email',$data,function($messages) use ($user){
                    $messages->to($user['to']);
                    $messages->subject("Forgot Password");
                });
                return response()->json(['status'=>'success','msg'=>'Please check your email for password']);
            }else{
                return response()->json(['status'=>'error','msg'=>'Email id not registered']);
            }
        }


 public function Checkout(Request $request)
 {

    $result['cart_data']=getAddToCartTotalItem();

    if(isset($result['cart_data'][0])){

        if($request->session()->has('FRONT_USER_LOGIN')){
            $uid=$request->session()->get('FRONT_USER_ID');
            $customer_info=DB::table('customers')
                ->where(['id'=> $uid])
                 ->get();
            $result['customers']['name']=$customer_info[0]->name;
            $result['customers']['email']=$customer_info[0]->email;
            $result['customers']['mobile']=$customer_info[0]->mobile;
            $result['customers']['address']=$customer_info[0]->address;
            $result['customers']['city']=$customer_info[0]->city;
            $result['customers']['state']=$customer_info[0]->state;

            $result['customers']['zip']=$customer_info[0]->zip;
        }else{
            $result['customers']['name']='';
            $result['customers']['email']='';
            $result['customers']['mobile']='';
            $result['customers']['address']='';
            $result['customers']['city']='';
            $result['customers']['state']='';

            $result['customers']['zip']='';
        }

        return view('Frontend.Product.Checkout',$result);
    }else{
        return redirect('/');
    }
}

public function apply_coupon_code(Request $request)
    {
        $arr=apply_coupon_code($request->coupon_code);
        $arr=json_decode($arr,true);

        return response()->json(['status'=>$arr['status'],'msg'=>$arr['msg'],'totalPrice'=>$arr['totalPrice']]);
   }

    public function remove_coupon_code(Request $request)
    {
        $totalPrice=0;
        $result=DB::table('coupons')
        ->where(['code'=>$request->coupon_code])
        ->get();
        $getAddToCartTotalItem=getAddToCartTotalItem();
        $totalPrice=0;
        foreach($getAddToCartTotalItem as $list){
            $totalPrice=$totalPrice+($list->qty*$list->price);
        }

        return response()->json(['status'=>'success','msg'=>'Coupon code removed','totalPrice'=>$totalPrice]);
    }



    public function place_order(Request $request)
    {
        $payment_url=0;
        if($request->session()->has('FRONT_USER_LOGIN')){
            $coupon_value=0;
            if($request->coupon_code!=''){
                $arr=apply_coupon_code($request->coupon_code);
                $arr=json_decode($arr,true);
                if($arr['status']=='success'){
                    $coupon_value=$arr['coupon_code_value'];
                }else{
                    return response()->json(['status'=>'false','msg'=>$arr['msg']]);
                }
            }


            $uid=$request->session()->get('FRONT_USER_ID');
            $totalPrice=0;
            $getAddToCartTotalItem=getAddToCartTotalItem();
            foreach($getAddToCartTotalItem as $list){
                $totalPrice=$totalPrice+($list->qty*$list->price);
            }
            $arr=[
                "customers_id"=>$uid,
                "name"=>$request->name,
                "email"=>$request->email,
                "mobile"=>$request->mobile,
                "address"=>$request->address,
                "city"=>$request->city,
                "state"=>$request->state,
                "pincode"=>$request->zip,
                "coupon_code"=>$request->coupon_code,
                "coupon_value"=>$coupon_value,
                "payment_type"=>$request->payment_type,
                "payment_status"=>"Pending",
                "total_amt"=>$totalPrice,
                "order_status"=>1,
                "added_on"=>date('Y-m-d h:i:s')
            ];
            $order_id=DB::table('orders')->insertGetId($arr);

            if($order_id>0){
                foreach($getAddToCartTotalItem as $list){
                    $prductDetailArr['product_id']=$list->pid;
                    $prductDetailArr['products_attr_id']=$list->attr_id;
                    $prductDetailArr['price']=$list->price;
                    $prductDetailArr['qty']=$list->qty;
                    $prductDetailArr['orders_id']=$order_id;
                    DB::table('orders_details')->insert($prductDetailArr);
                }

                if($request->payment_type=='Gateway'){
                    $final_amt=$totalPrice-$coupon_value;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
                    curl_setopt($ch, CURLOPT_HEADER, FALSE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                    curl_setopt($ch, CURLOPT_HTTPHEADER,
                        array("X-Api-Key:KEY",
                            "X-Auth-Token:TOKEN"));
                    $payload = Array(
                        'purpose' => 'Buy Product',
                        'amount' => $final_amt,
                        'phone' => $request->mobile,
                        'buyer_name' =>$request->name,
                        'redirect_url' => 'http://127.0.0.1:8000/instamojo_payment_redirect',
                        'send_email' => true,
                        'send_sms' => true,
                        'email' => $request->email,
                        'allow_repeated_payments' => false
                    );
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
                    $response = curl_exec($ch);
                    curl_close($ch);
                    $response=json_decode($response);
                    if(isset($response->payment_request->id)){
                        $txn_id=$response->payment_request->id;
                        DB::table('orders')
                        ->where(['id'=>$order_id])
                        ->update(['txn_id'=>$txn_id]);
                        $payment_url=$response->payment_request->longurl;
                    }else{
                        $msg="";
                        foreach($response->message as $key=>$val){
                            $msg.=strtoupper($key).": ".$val[0].'<br/>';
                        }
                        return response()->json(['status'=>'error','msg'=>$msg,'payment_url'=>'']);
                    }

                }


                // DB::table('cart')->where(['user_id'=>$uid,'user_type'=>'Reg'])->delete();
                $request->session()->put('ORDER_ID',$order_id);

                $status="success";
                $msg="Order placed";
            }else{
                $status="false";
                $msg="Please try after sometime";
            }
        }else{
            $status="false";
            $msg="Please login to place order";
        }
        return response()->json(['status'=>$status,'msg'=>$msg,'payment_url'=>$payment_url]);

    }

    public function order_placed(Request $request)
    {
        if($request->session()->has('ORDER_ID')){
            return view('Frontend.Product.order_placed');
        }else{
            return redirect('/');
        }
    }


    public function order_fail(Request $request)
    {
        if($request->session()->has('ORDER_ID')){
            return view('Frontend.Project.order_fail');
        }else{
            return redirect('/');
        }
    }

    public function instamojo_payment_redirect(Request $request)
    {


        if($request->get('payment_id')!==null && $request->get('payment_status')!==null && $request->get('payment_request_id')!==null){
            if($request->get('payment_status')=='Credit'){
                $status='Success';
                $redirect_url='/order_placed';
            }else{
                $status='Fail';
                $redirect_url='/order_fail';
            }
            $request->session()->put('ORDER_STATUS',$status);
            DB::table('orders')
                ->where(['txn_id'=>$request->get('payment_request_id')])
                ->update(['payment_status'=>$status,'payment_id'=>$request->get('payment_id')]);
                return redirect($redirect_url);
        }else{
            die('Something went wrong');
        }
    }

 public function order(Request $request)
 {

//    prx($result);
$result['orders']=DB::table('orders')
->select('orders.*','orders_status.orders_status')
->leftJoin('orders_status','orders_status.id','=','orders.order_status')
->where(['orders.customers_id'=>$request->session()->get('FRONT_USER_ID')])
->get();
      return view('Frontend.Product.order',$result);
 }
 public function order_detail(Request $request,$id)
 {
    $result['orders_details']=
    DB::table('orders_details')
    ->select('orders.*','orders_details.price','orders_details.qty','products.name as pname','products_attr.attr_image','sizes.size','colors.color','orders_status.orders_status')
    ->leftJoin('orders','orders.id','=','orders_details.orders_id')
    ->leftJoin('products_attr','products_attr.id','=','orders_details.products_attr_id')
    ->leftJoin('products','products.id','=','products_attr.products_id')
    ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
    ->leftJoin('orders_status','orders_status.id','=','orders.order_status')
    ->leftJoin('colors','colors.id','=','products_attr.color_id')
    ->where(['orders.id'=>$id])
    ->where(['orders.customers_id'=>$request->session()->get('FRONT_USER_ID')])
    ->get();
if(!isset($result['orders_details'][0]))
{
    return redirect('/');
}
// prx($result['orders_details']);
      return view('Frontend.Product.order_detail',$result);
 }

}




