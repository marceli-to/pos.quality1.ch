<?php
namespace App\Services;
use App\Models\Post;
use App\Models\Voter as VoterModel;
use App\Models\Vote as VoteModel;
use App\Stores\Store;
use Illuminate\Http\Request;

class Vote
{
  public function __construct(Post $post, VoteModel $vote, VoterModel $voter, Store $store)
  {
    $this->post  = $post;
    $this->vote  = $vote;
    $this->voter = $voter;
    $this->store = $store;
  }

  /**
   * Check for existing votes for a given voterId
   * 
   * @param \Illuminate\Http\Request $request
   * @param String $uuid
   * @return mixed
   */

  public function check(Request $request, $hash = NULL)
  {
    // Get voter
    $voter = $this->getVoter($hash);

    // Get current post id
    $postId = $this->store->getAttribute('post_id');

    if (!$voter)
    {
      $this->createVoter($request, $hash);
      return ['vote_allowed' => true];
    }

    $votes = $this->vote->where('voter_id', '=', $voter->id)->where('post_id', '=', $postId)->get();
    return ['has_vote' => count($votes) > 0 ? true : false];
  }

  /**
   * Store a vote
   *
   * @param \Illuminate\Http\Request $request
   * @param String $hash
   * @param String $uuid
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $hash = NULL, $uuid = NULL)
  { 
    if (!$hash || !$uuid)
    {
      abort(403);
    }

    // Get voter & post
    $voter = $this->getVoter($hash);
    $post  = $this->getPost($uuid);

    if (!$voter)
    {
      // Create voter
      $voter = $this->createVoter($request, $hash);
    }
    
    $vote = $this->hasVote($voter, $post);

    // Create or delete vote
    if (!$vote)
    {
      $vote = VoteModel::create([
        'voter_id' => $voter->id,
        'post_id' => $post->id
      ]);
      return ['hasVote' => TRUE, 'votes' => $this->getVotes($post->id)];
    }
    else
    {
      $vote->delete();
      return ['hasVote' => FALSE, 'votes' => $this->getVotes($post->id)];
    }
  }


  /**
   * Check for existing vote
   * 
   * @param \App\Models\Voter $voter
   * @param \App\Models\Post $post
   * @param $postId
   */
  public function hasVote(VoterModel $voter, Post $post)
  {
    return $this->vote->where('voter_id', '=', $voter->id)
                      ->where('post_id', '=', $post->id)
                      ->get()
                      ->first();
  }

  /**
   * Get post by uuid
   *
   * @param  String $uuid
   * @return Post $post
   */

  public function getPost($uuid = NULL)
  {
    return $this->post->where('uuid', '=', $uuid)->firstOrFail();
  }

  /**
   * Get vote count for a certain post
   *
   * @param  Integer $postId
   * @return Integer $count
   */

  public function getVotes($postId = NULL)
  {
    $votes = $this->vote->where('post_id', '=', $postId)->get();
    return $votes->count();
  }

  /**
   * Get a voter from either:
   * - Session 
   * - DB
   *
   * @param  string $hash
   * @return VoterModel $voter
   */

  public function getVoter($hash = NULL)
  {
    $storedHash = $this->store->getAttribute('hash');
    if ($storedHash)
    {
      return $this->voter->where('hash', '=', $storedHash)->get()->first();
    }
    $this->store->setAttribute('hash', $hash);
    return $this->voter->where('hash', '=', $hash)->get()->first();
  }

  /**
   * Create a voter
   *
   * @param \Illuminate\Http\Request $request
   * @param  string $hash
   * @return VoterModel $voter
   */

  public function createVoter($request, $hash = NULL)
  {
    $voter = VoterModel::create([
      'ip_address' => md5($this->getClientIPaddress($request)),
      'hash' => $hash
    ]);
    $this->store->setAttribute('hash', $hash);
    return $voter;
  }

  /**
   * Get a users IP address
   * @param \Illuminate\Http\Request $request
   */
  private function getClientIPaddress(Request $request)
  {
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"]))
    {
      $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
      $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }

    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP))
    {
      $clientIp = $client;
    }
    else if (filter_var($forward, FILTER_VALIDATE_IP))
    {
      $clientIp = $forward;
    }
    else
    {
      $clientIp = $remote;
    }
    return $clientIp;
  }

}