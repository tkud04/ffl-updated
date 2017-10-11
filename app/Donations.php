<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Donations extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['transaction_id', 'giver_id', 'receiver_id', 'amount', 'valid', 'status'];

}
