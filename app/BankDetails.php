<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDetails extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bank_details';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'bank_name','acc_name', 'acc_num'];

}