<?php
namespace App\Http\Controllers\Api;
use App\Services\Vote;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Http\Requests\VoteRequest;
use Illuminate\Http\Request;

class VoteController extends Controller
{
  public function __construct(Vote $vote)
  {
    $this->vote = $vote;
  }

  /**
   * Check for existing votes
   * 
   * @param \Illuminate\Http\Request $request
   * @param String $hash
   * @return \Illuminate\Http\Response
   */

  public function check(Request $request, $hash = NULL)
  { 
    return response()->json(
      $this->vote->check($request, $hash)
    );
  }

  /**
   * Store a vote
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(VoteRequest $request)
  {
    return response()->json(
      $this->vote->store($request, $request->hash, $request->uuid)
    );
  }

}
