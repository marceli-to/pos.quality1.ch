<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderNotification extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(Order $order)
  {
    $this->order = $order;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $mail = $this->from(['address' => env('QUALITY1_MAIL_REPLY_TO')])
                 ->subject('Bestellung POS – Quality1')
                 ->with(['order' => json_decode($this->order)])
                 ->markdown('emails.order.notification');
    return $mail;
  }
}
