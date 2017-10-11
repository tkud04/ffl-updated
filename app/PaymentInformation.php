<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentInformation extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['donation_id', 'payment_type', 'slip_name', 'payment_image'];

}
