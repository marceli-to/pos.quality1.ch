<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Base
{
	use SoftDeletes;

	protected $fillable = [
		'uuid',
		'company',
		'name',
		'email',
		'publish'
	];

  /**
   * Scope for published posts
   */

	public function scopePublished($query)
	{
		return $query->where('publish', '=', 1)->orderBy('created_at', 'DESC');
	}

  /**
   * Scope for non published posts
   */

	public function scopeNonPublished($query)
	{
		return $query->where('publish', '=', 0)->orderBy('created_at', 'DESC');
  }


}