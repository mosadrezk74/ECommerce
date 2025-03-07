<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{

        public function index()
        {
            ##For Admin##

            $products=Product::with('category')->get();
           return view('Admin/Product/Product',compact('products'));

        }
        public function create(){

            $products=Product::with('category')->get();
            $categories=Category::all();
            $brands=Brand::all();
            $taxes=Tax::all();
            return view('Admin/Product/create',compact('products' ,
                'categories'
            ,'brands'
            ,'taxes'
            ));
        }
        public function  store(Request $request)
        {
                $products = new Product();
                $products->name = strip_tags($request->name);
                $products->category_id = strip_tags($request->category_id);
                $products->brand_id = strip_tags($request->brand_id);
                $products->model = strip_tags($request->model);
                $products->short_desc = strip_tags($request->short_desc);
                $products->desc = strip_tags($request->desc);
                $products->keywords = strip_tags($request->keywords);
                $products->technical_specification = strip_tags($request->technical_specification);
                $products->price = strip_tags($request->price);
                $products->warranty = strip_tags($request->warranty);
                $products->tax_id = strip_tags($request->tax_id);
                $products->is_promo = strip_tags($request->is_promo);
                $products->is_featured = strip_tags($request->is_featured);
                $products->is_tranding = strip_tags($request->is_tranding);
                $products->status = strip_tags($request->status);

            if($request->hasfile('photo'))
            {
                $file = $request->file('photo');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time().'.'.$extenstion;
                $file->move('uploads/students/', $filename);
                $products->photo = $filename;
            }

                $products->save();
                return redirect('admin/product');

        }


    public function cart()
    {
        $products = session()->get('cart');
        $total = 0;
        foreach ($products as $product) {
            $total += $product['price'] * $product['quantity'];
        }
        $taxes = Tax::all();
        $brands = Brand::all();
        $categories = Category::all();
        $cart = session()->get('cart');
        return view('Website.cart', compact('products'
            ,'total',
            'cart',
            'total', 'taxes', 'brands', 'categories'));
     }
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }  else {
            $cart[$id] = [
                "name" => $product->name,
                "photo" => $product->photo,
                "price" => $product->price,
//                "quantity" => $product->quantity,
                'quantity' => request('quantity', 1),

                "short_desc" => $product->short_desc
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product add to cart successfully!');
    }


    public function filter(Request $request)
    {
        // Retrieve filter parameters from the request (e.g., category and price range).
        $category = $request->input('category');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        // Build the query based on the filters.
        $query = Product::query();

        if ($category) {
            $query->where('category_id', $category);
        }

        if ($minPrice && $maxPrice) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        // Execute the query and return the filtered results as JSON.
        $filteredProducts = $query->get();

        return response()->json($filteredProducts);
    }



    public function delete(Request $request,$id)
        {
            $data=Product::find($id);
            $data->delete();
            $request->session()->flash('message','Product is successfully deleted');
            return redirect('admin/product');
        }

        public function product_images_delete(Request $request,$paid,$pid){

            $arrImage=DB::table('product_images')->where(['id'=>$paid])->get();
          if( Storage::exists('/public/media/'.$arrImage[0]->images)){


            Storage::delete('/public/media/'.$arrImage[0]->images);
        }
            DB::table('product_images')->where(['id'=>$paid])->delete();
            return redirect('admin/product/manage_product/'.$pid);
        }

        public function status(Request $request,$status,$id)
        {
            $data=Product::find($id);
            $data->status=$status;
            $data->save();
            $request->session()->flash('message','Product Status is successfully Updated');
            return redirect('admin/product');


        }


    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);

            // Update the cart in the session
            session()->put('cart', empty($cart) ? null : $cart);
        }

        return redirect()->route('cart')->with('success', 'Item removed from cart');
    }

    public function search(Request $request){

        $products = Product::with('category')
            ->where('name', 'like', "%{$request->keyword}%")
            ->orWhere('short_desc', 'like', "%{$request->keyword}%")
            ->paginate(9);
        $categories = Category::all();

        return view('Website.shop', compact('products' , 'categories' ));
    }



}


