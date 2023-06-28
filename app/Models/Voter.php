<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;

class Voter extends Base
{
	protected $fillable = [
		'ip_address',
		'hash',
  ];

	public function votes()
	{
		return $this->hasMany('App\Models\Vote', 'voter_id', 'id');
	}

}