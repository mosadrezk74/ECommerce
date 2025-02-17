<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    // Create payment intent
    public function createPaymentIntent(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'currency' => 'sometimes|string|max:3'
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount * 100,
                'currency' => $request->currency ?? 'usd',
                'metadata' => [
                    'user_id' => auth()->id()
                ]
            ]);

            return response()->json([
                'client_secret' => $paymentIntent->client_secret,
                'payment_intent_id' => $paymentIntent->id
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Confirm payment
    public function confirmPayment(Request $request)
    {
        $request->validate([
            'payment_intent_id' => 'required|string'
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);

            // Add additional checks
            if ($paymentIntent->status === 'requires_action') {
                return response()->json([
                    'requires_action' => true,
                    'client_secret' => $paymentIntent->client_secret
                ]);
            }

            if ($paymentIntent->status !== 'succeeded') {
                return response()->json([
                    'error' => 'Payment failed: ' . $paymentIntent->last_payment_error?->message,
                    'status' => $paymentIntent->status
                ], 400);
            }

            // Save successful payment
            // Add your database logic here

            return response()->json([
                'status' => 'success',
                'payment' => $paymentIntent
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
