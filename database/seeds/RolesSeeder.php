<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesSeeder extends DatabaseSeeder {

	/**
	 * Add roles and permissions to the database
	 *
	 * @return void
	 */
	public function run()
	{
		$permissions = array(
			array( 'name' => 'admin' ),				//Access admin area
			array( 'name' => 'edit_settings' ),		//Edit site settings
			array( 'name' => 'add_users' ),
			array( 'name' => 'edit_users' ),
			array( 'name' => 'assign_roles' ),		//Assign roles to users
			array( 'name' => 'delete_users' ),
			array( 'name' => 'add_products' ),
			array( 'name' => 'edit_products' ),
			array( 'name' => 'delete_products' ),
			array( 'name' => 'add_orders' ),
			array( 'name' => 'edit_orders' ),
			array( 'name' => 'delete_orders' ),
		);

		$roles = array(
			array(
				'name' 			=> 'admin',
				'display_name' 	=> 'Admin user',
				'description' 	=> 'User able to edit and manage entire website',
				'permissions'	=> array(
					'admin',
					'edit_settings',
					'add_users',
					'edit_users',
					'assign_roles',
					'delete_users',
					'add_products',
					'edit_products',
					'delete_products',
					'add_orders',
					'edit_orders',
					'delete_orders',
				)
			),
			array(
				'name' 			=> 'customer',
				'display_name' 	=> 'Shop customer',
				'description' 	=> 'Able to access front end of site only',
				'permissions'	=> array()
			),
			array(
				'name' 			=> 'wholesale-customer',
				'display_name' 	=> 'Wholesale customer',
				'description' 	=> 'Able to access front end of site only and purchase at wholesale prices',
				'permissions'	=> array()
			)
		);

		//Add permissions
		$p = new App\Permission;
		foreach( $permissions as $permission ){
			$p->create($permission);
		}

		//Add Roles
		foreach( $roles as $role ){
			$r = new App\Role;

			//Create the role
			$r->name 		 = $role['name'];
			$r->display_name = $role['display_name'];
			$r->description  = $role['description'];
			$r->save();

			//Get roles permissions
			$permissions = $p->whereIn('name', $role['permissions'])->get(['id'])->toArray();

			//Add the permissions
			foreach( $permissions as $permission ){
				$r->permissions()->attach($permission['id']);
			}

		}
	}

}
