<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Base
{
	use SoftDeletes;

	protected $fillable = [
		'company',
		'name',
    'street',
    'zip',
    'city',
		'email',
    'plate_front',
    'plate_back',
    'flag',
	];
}