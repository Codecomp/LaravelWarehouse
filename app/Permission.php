<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'permissions';

	/**
	 * Remove created_at and updated_at timestamps from model
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

	/**
	 * Get the roles that have this permission
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function roles()
	{
		return $this->belongsToMany('App\Role');
	}

}