<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponApplicationController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Code' => 'required|unique:Coupons',
            'DiscountType' => 'required|in:percentage,fixed',
            'DiscountValue' => 'required|numeric|min:0',
            'ValidFrom' => 'required|date',
            'ValidTo' => 'required|date|after:ValidFrom',
            'UsageLimit' => 'nullable|integer|min:1',
            'MinOrderAmount' => 'nullable|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $coupon = Coupon::create($validator->validated());
        return response()->json($coupon, 201);
    }

    // Validate and apply coupon
    public function applyCoupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Code' => 'required|exists:Coupons,Code',
            'OrderAmount' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $coupon = Coupon::where('Code', $request->Code)->first();
        $user = auth()->user();

        // Validation checks
        $errors = [];

        if (!$coupon->IsActive) {
            $errors[] = 'Coupon is not active';
        }

        if (now()->lt($coupon->ValidFrom)) {
            $errors[] = 'Coupon is not yet valid';
        }

        if (now()->gt($coupon->ValidTo)) {
            $errors[] = 'Coupon has expired';
        }

        if ($coupon->UsageLimit && $coupon->UsedCount >= $coupon->UsageLimit) {
            $errors[] = 'Coupon usage limit reached';
        }

        if ($coupon->MinOrderAmount && $request->OrderAmount < $coupon->MinOrderAmount) {
            $errors[] = 'Minimum order amount not met';
        }

        if (CouponUsage::where('UserID', $user->UserID)
            ->where('CouponID', $coupon->CouponID)
            ->exists()) {
            $errors[] = 'You have already used this coupon';
        }

        if (!empty($errors)) {
            return response()->json(['errors' => $errors], 400);
        }

        // Calculate discount
        $discount = $coupon->DiscountType === 'percentage'
            ? ($request->OrderAmount * $coupon->DiscountValue) / 100
            : $coupon->DiscountValue;

        return response()->json([
            'coupon' => $coupon,
            'discount' => round($discount, 2),
            'new_total' => round($request->OrderAmount - $discount, 2)
        ]);
    }

    // Record coupon usage after successful order
    public function recordUsage(Request $request)
    {
        $coupon = Coupon::where('Code', $request->Code)->first();

        CouponUsage::create([
            'UserID' => auth()->id(),
            'CouponID' => $coupon->CouponID,
            'OrderID' => $request->OrderID
        ]);

        $coupon->increment('UsedCount');

        return response()->json(['message' => 'Coupon usage recorded']);
    }
}
