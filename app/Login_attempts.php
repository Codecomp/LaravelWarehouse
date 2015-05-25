<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Login_attempts extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'login_attempts';

	/**
	 * Remove created_at and updated_at timestamps from model
	 *
	 * @var bool
	 */
	public $timestamps = false;

}