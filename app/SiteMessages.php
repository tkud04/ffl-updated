<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteMessages extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['message', 'in_use'];

}
