<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call('DistrictsTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('UsersgroupsTableSeeder');
		$this->call('TeamsTableSeeder');
		$this->call('GroupsTableSeeder');
	}

}