<?php

class DistrictsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$items = array(
			array(
	        'id' => '1',
	        'name' => 'District A',
	        'steward' => '1',
	        'created_at' => new DateTime,
	        'updated_at' => new DateTime,
	        )
	    );

		DB::table('districts')->insert($items);
	}

}