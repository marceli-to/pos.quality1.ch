<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class PageController extends BaseController
{
  protected $viewPath = 'web.pages.';
  
  /**
   * Show the landing page
   * @param Post $post
   * @return \Illuminate\Http\Response
   */

  public function index(Post $post = NULL)
  { 
    if ($post)
    {
      $post = Post::published()->findOrFail($post->id);
      return view($this->viewPath . 'index', ['post' => $post]);
    }
    return view($this->viewPath . 'index');
  }
}