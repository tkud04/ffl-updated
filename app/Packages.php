<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'price', 'enabled','hype'];

}
