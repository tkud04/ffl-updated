<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountStatus extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'package_id', 'status','verified', 'activated', 'pin_id','enabled', 'merged', 'awaiting_pay'];

}
