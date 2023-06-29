<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\Post;
use App\Http\Requests\PostStoreRequest;
use App\Events\PostPublish;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function __construct(Post $post)
  {
    $this->post = $post;
  }

  /**
   * Get a list of post
   * 
   * @param String $type
   * @return \Illuminate\Http\Response
   */
  public function get($type = NULL)
  {
    $posts = [];
    switch($type)
    {
      case 'nonpublished':
        $posts = $this->post->nonPublished()->get();
      break;
      case 'published':
        $posts = $this->post->published()->get();
      break;
      case 'trashed':
        $posts = $this->post->onlyTrashed()->get();
      break;
    }

    return new DataCollection($posts);
  }

  /**
   * Get a list of post with votes
   * 
   * @return \Illuminate\Http\Response
   */
  public function votes()
  {
    return new DataCollection($this->post->with('votes')->get());
  }

  /**
   * Get a single post for a given post or authenticated post
   * 
   * @param Post $post
   * @return \Illuminate\Http\Response
   */
  public function find(Post $post)
  {
    $post = $this->post->findOrFail($post->id);
    return response()->json($post);
  }

  /**
   * Toggle the status a given Post
   *
   * @param  Post $post
   * @return \Illuminate\Http\Response
   */
  public function toggle(Post $post)
  {
    $post->publish = $post->publish == 0 ? 1 : 0;
    $post->save();

    // if ($post->publish == 1)
    // {
    //   event(new PostPublish($post));
    // }

    return response()->json($post->publish);
  }

  /**
   * Remove a Post
   *
   * @param  Post $post
   * @return \Illuminate\Http\Response
   */
  public function destroy(Post $post)
  {
    $post->delete();
    return response()->json('successfully deleted');
  }

  /**
   * Restore a deleted post
   *
   * @param  integer $id
   * @return \Illuminate\Http\Response
   */
  public function restore($id)
  {
    $post = $this->post->withTrashed()->findOrFail($id);
    $post->publish = 0; 
    $post->restore();
    return response()->json($post);
  }
}
