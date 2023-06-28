<?php
namespace App\Listeners;
use App\Events\PostPublish;
use App\Mail\PostNotification;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostPublishNotification
{

  /**
   * Handle the event.
   *
   * @param  ContactFormSubmit $event
   * @return void
   */
  public function handle(PostPublish $event)
  {
    // Get the post
    $post = $event->post->find($event->post->id);
  
    // Notify post user
    $this->notify($post);
  }

  /**
   * Send request
   * 
   * @param Order $order
   * @return void
   */

  public function notify(Post $post)
  {
    Mail::to($post->email)->send(new PostNotification($post));
  }
}
