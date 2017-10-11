<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderImages extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['image', 'position'];

}
