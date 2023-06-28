<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Post;
use App\Services\Media;
use App\Stores\Store;
use App\Http\Requests\PostImageUploadRequest;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PostController extends BaseController
{
  protected $viewPath = 'web.pages.';
  
  /**
   * Get all posts
   * @param  Request $request
   * @return \Illuminate\Http\Response
   */

  public function get(Request $request)
  { 
    // Get limit
    $limit = 12;
    $offset = $request->offset;

    $data = Post::published()->skip($offset)->take($limit)->get();

    // Get posts
    $posts = [];

    if ($data)
    {
      foreach($data as $post)
      {
        $posts[] = [
          'uuid' => $post->uuid,
          'company' => $post->company,
          'name' => $post->name,
          'message' => $post->message,
          'image' => $post->image,
        ];
      }
    }

    return response()->json(['posts' => collect($posts)]);
  }

  /**
   * Get a single posts
   * @param Request $request
   * @param Sting $uuid
   * @return \Illuminate\Http\Response
   */

  public function find(Request $request)
  { 
    $post = Post::where('uuid', '=', $request->uuid)->firstOrFail();

    $data = [
      'uuid' => $post->uuid,
      'company' => $post->company,
      'name' => $post->name,
      'message' => $post->message,
      'image' => $post->image,
    ];

    return response()->json(['post' => collect($data)]);
  }

  /**
   * Upload a post image
   * 
   * @param  PostImageUploadRequest $request
   * @return \Illuminate\Http\Response
   */

  public function upload(PostImageUploadRequest $request)
  { 
    $media = (new Media(['force_lowercase' => false]))->store($request);
    return response()->json($media);
  }

  /**
   * Store a post
   * 
   * @param  PostStoreRequest $request
   * @return \Illuminate\Http\Response
   */

  public function store(PostStoreRequest $request)
  { 
    $post = Post::create([
      'uuid'  => \Str::uuid(),
      'image' => $request->input('image'),
      'email' => $request->input('email'),
      'name' => $request->input('name'),
      'company' => $request->input('company'),
      'message' => $request->input('message'),
    ]);

    if ($post)
    {
      $media = (new Media())->copy($request->input('image'));
    }

    return response()->json($post->uuid);
  }

  public function download()
  {
    $posts = Post::published()->get();
    $uri = 'https://20years.quality1.ch/image/opengraph/';
    if ($posts)
    {
      foreach($posts as $p)
      {
        $image = $uri . $p->image; 
        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
        file_put_contents(storage_path('app/public/downloads/') . $p->image, file_get_contents($image));
      }
    }
    die();
  }
}
