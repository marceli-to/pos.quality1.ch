<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;

class PostNotification extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(Post $post)
  {
    $this->post = $post;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $mail = $this->from(['address' => env('QUALITY1_MAIL_REPLY_TO')])
                 ->subject('POS – Quality1')
                 ->with(['post' => json_decode($this->post)])
                 ->markdown('emails.notification');
    return $mail;
  }
}
