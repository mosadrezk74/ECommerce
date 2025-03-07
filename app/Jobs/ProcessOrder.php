<?php

namespace App\Jobs;

use Mail;
use App\Models\Order;
// use App\Mail\OrderProcessed;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\OrderProcessed;

class ProcessOrder implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        // معالجة الطلب
        $this->order->status = 'processed';
        $this->order->save();

        // إرسال بريد إلكتروني
        Mail::to($this->order->user->email)->send(new OrderProcessed($this->order));
        event(new OrderProcessed($this->order));
    }
}
