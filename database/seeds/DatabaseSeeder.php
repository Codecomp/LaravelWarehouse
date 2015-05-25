<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('RolesSeeder');
		$this->command->info('User roles seeded');

		if (App::environment() !== 'production') {
			//Test data


		} else {
			//Production data


		}
	}

}
