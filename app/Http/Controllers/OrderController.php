<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Post;
use App\Models\Voter as VoterModel;
use App\Models\Vote as VoteModel;
use App\Services\Media;
use App\Services\Vote;
use App\Stores\Store;
use App\Http\Requests\PostImageUploadRequest;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PostController extends BaseController
{
  protected $viewPath = 'web.pages.';
  
  public function __construct(Post $post, Vote $vote, Store $store)
  {
    $this->post = $post;
    $this->vote = $vote;
    $this->store = $store;
  }

  /**
   * Show the landing page
   * @param String $post
   * @return \Illuminate\Http\Response
   */

  public function index(Post $post = NULL)
  { 
    if ($post)
    {
      $post = $this->post->published()->withCount('votes')->with('votes.voter')->findOrFail($post->id);
      return view($this->viewPath . 'index', ['post' => $post]);
    }
    return view($this->viewPath . 'index');
  }

  /**
   * Get all posts
   * @param  Request $request
   * @return \Illuminate\Http\Response
   */

  public function get(Request $request)
  { 
    // Get hash
    $hash = $this->store->getAttribute('hash') ? 
            $this->store->getAttribute('hash') : 
            $request->hash;

    // Get or create voter
    $voter = $this->vote->getVoter($hash);
    if (!$voter)
    {
      $voter = $this->vote->createVoter($request, $hash);
    }

    // Get limit
    $limit = 12;
    $offset = $request->offset;

    $data = $this->post->withCount('votes')
                        ->with('votes.voter')
                        ->orderBy('votes_count', 'desc')
                        ->published()
                        ->skip($offset)
                        ->take($limit)
                        ->get();

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
          'votes' => [
            'count' => $post->votes->count(),
            'hasVote' => $post->votes->whereIn('voter_id', $voter->id)->count() > 0 ? true : false
          ],
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
    // Get hash
    $hash = $this->store->getAttribute('hash') ? 
            $this->store->getAttribute('hash') : 
            $request->hash;

    // Get or create voter
    $voter = $this->vote->getVoter($hash);
    if (!$voter)
    {
      $voter = $this->vote->createVoter($request, $hash);
    }

    $post = $this->post->withCount('votes')->with('votes.voter')->where('uuid', '=', $request->uuid)->firstOrFail();

    // Get posts
    $data = [
      'uuid' => $post->uuid,
      'company' => $post->company,
      'name' => $post->name,
      'message' => $post->message,
      'image' => $post->image,
      'votes' => [
        'count' => $post->votes->count(),
        'hasVote' => $post->votes->whereIn('voter_id', $voter->id)->count() > 0 ? true : false
      ],
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
    $posts = $this->post->published()->get();
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
