<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateUsersTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Create tables
		Schema::create('users', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('username', 30);
			$table->string('email', 100);
			$table->string('password', 100);
			$table->timestamps();
			$table->string('salt', 30);
			$table->string('register_ip', 15);
			$table->string('forget_token', 100)->nullable();
			$table->string('active_token', 100)->nullable();
		});

		Schema::create('login_attempts', function(Blueprint $table) {
			$table->increments('id');
			$table->bigInteger('user_id')->unsigned();
			$table->string('login_ip', 15);
			$table->timestamp('login_time');
		});

		Schema::create('roles', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 30)->unique();
			$table->string('display_name');
			$table->string('description');
		});

		Schema::create('role_user', function(Blueprint $table) {
			$table->integer('role_id')->unsigned();
			$table->bigInteger('user_id')->unsigned();
		});

		Schema::create('permissions', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 100);
		});

		Schema::create('permission_role', function(Blueprint $table) {
			$table->integer('permission_id')->unsigned();
			$table->integer('role_id')->unsigned();
		});


		//Create foreign keys
		Schema::table('permission_role', function(Blueprint $table) {
			$table->foreign('permission_id')->references('id')->on('permissions')
				->onDelete('cascade');

			$table->foreign('role_id')->references('id')->on('roles')
				->onDelete('cascade');
		});

		Schema::table('role_user', function(Blueprint $table) {
			$table->foreign('role_id')->references('id')->on('roles')
				->onDelete('cascade');

			$table->foreign('user_id')->references('id')->on('users')
				->onDelete('cascade');
		});

		Schema::table('login_attempts', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Drop foreign keys
		Schema::table('permission_role', function(Blueprint $table) {
			$table->dropForeign('permission_role_permission_id_foreign');
		});
		Schema::table('permission_role', function(Blueprint $table) {
			$table->dropForeign('permission_role_role_id_foreign');
		});
		Schema::table('role_user', function(Blueprint $table) {
			$table->dropForeign('role_user_role_id_foreign');
		});
		Schema::table('role_user', function(Blueprint $table) {
			$table->dropForeign('role_user_user_id_foreign');
		});
		Schema::table('login_attempts', function(Blueprint $table) {
			$table->dropForeign('login_attempts_user_id_foreign');
		});

		//Drop existing tables
		Schema::drop('users');
		Schema::drop('login_attempts');
		Schema::drop('roles');
		Schema::drop('role_user');
		Schema::drop('permissions');
		Schema::drop('permission_role');
	}

}
