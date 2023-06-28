<?php
namespace App\Listeners;
use App\Events\OrderComplete;
use App\Mail\OrderNotification;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderCompleteNotification
{

  /**
   * Handle the event.
   *
   * @param  OrderComplete $event
   * @return void
   */
  public function handle(OrderComplete $event)
  {
    // Get the order
    $order = $event->order->find($event->order->id);
  
    // Notify order user
    $this->notify($order);
  }

  /**
   * Send request
   * 
   * @param Order $order
   * @return void
   */

  public function notify(Order $order)
  {
    Mail::to(env('QUALITY1_MAIL_TO'))->send(new OrderNotification($order));
  }
}
