<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

        public function index(Request $request)
        {
            $products = Product::with(['category', 'supplier'])->get();

            return response()->json($products);
        }

        public function store(Request $request)
        {
            // vcr
            $validator = Validator::make($request->all(), [
                'ProductName' => 'required|string|max:100',
                'Description' => 'nullable|string',
                'Price' => 'required|numeric|min:0',
                'StockQuantity' => 'required|integer|min:0',
                'SKU' => 'required|string|unique:Products,SKU|max:50',
                'ImageURL' => 'nullable|url',
                'CategoryID' => 'required|exists:Categories,CategoryID',
                'SupplierID' => 'nullable|exists:Suppliers,SupplierID',
                'IsActive' => 'boolean'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $product = Product::create($validator->validated());

            return response()->json($product, 201);
        }


        public function show($id)
        {
            $product = Product::with(['category', 'supplier'])
                ->findOrFail($id);

            return response()->json($product);
        }

        public function update(Request $request, $id)
        {
            $product = Product::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'ProductName' => 'sometimes|string|max:100',
                'Description' => 'nullable|string',
                'Price' => 'sometimes|numeric|min:0',
                'StockQuantity' => 'sometimes|integer|min:0',
                'SKU' => 'sometimes|string|unique:Products,SKU,'.$id.',ProductID|max:50',
                'ImageURL' => 'nullable|url',
                'CategoryID' => 'sometimes|exists:Categories,CategoryID',
                'SupplierID' => 'nullable|exists:Suppliers,SupplierID',
                'IsActive' => 'sometimes|boolean'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $product::update($validator->validated());

            return response()->json($product);
        }

        public function destroy($id)
        {
            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json(['message' => 'Product deleted successfully']);
        }
}
