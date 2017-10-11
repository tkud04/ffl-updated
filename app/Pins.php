<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Pins extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['number', 'used_by', 'pin_count', 'valid'];

}
