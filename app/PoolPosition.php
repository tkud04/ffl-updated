<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PoolPosition extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'next', 'package', 'remain', 'amount', 'priority', 'ghcount'];

}
