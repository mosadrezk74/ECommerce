<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Notifications\OrderShipped;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function shipOrder(Request $request, $orderId)
    {
        $user = $request->user();
        $order = Order::findOrFail($orderId);

        if ($user->api_token) {
            $order->user->notify(new OrderShipped($order));
            return response()->json(['message' => 'Order shipped and notification sent!'], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications;
        return response()->json($notifications, 200);
    }

    public function markAsRead(Request $request, $id)
    {
        $notification = $request->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return response()->json(['message' => 'Notification marked as read'], 200);
    }
}
