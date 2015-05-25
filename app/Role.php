<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';

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
	protected $fillable = ['name', 'display_name', 'description'];

	/**
	 * Get the permissions associated to a given role
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function permissions()
	{
		return $this->belongsToMany('App\Permission');
	}

	/**
	 * Get the users associated with this role
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users()
	{
		return $this->belongsToMany('App\User');
	}

}