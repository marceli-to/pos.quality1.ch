<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;

class Vote extends Base
{
	protected $fillable = [
		'post_id',
		'voter_id',
  ];

  public function post()
  {
    return $this->belongsTo('App\Models\Post');
  }

  public function voter()
  {
    return $this->belongsTo('App\Models\Voter');
  }

}