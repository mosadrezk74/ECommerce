<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::with('products')->paginate(10);
        return response()->json($suppliers);
    }

    /**
     * Create a new supplier.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'SupplierName' => 'required|string|max:100',
            'ContactName' => 'required|string|max:100',
            'PhoneNumber' => 'required|string|max:15',
            'Email' => 'required|email|unique:Suppliers,Email',
            'Address' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $supplier = Supplier::create($validator->validated());
        return response()->json($supplier, 201);
    }

    public function show($id)
    {
        $supplier = Supplier::with('products')->findOrFail($id);
        return response()->json($supplier);
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'SupplierName' => 'sometimes|string|max:100',
            'ContactName' => 'sometimes|string|max:100',
            'PhoneNumber' => 'sometimes|string|max:15',
            'Email' => 'sometimes|email|unique:Suppliers,Email,'.$id.',SupplierID',
            'Address' => 'sometimes|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $supplier->update($validator->validated());
        return response()->json($supplier);
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return response()->json(['message' => 'Supplier deleted']);
    }
}
