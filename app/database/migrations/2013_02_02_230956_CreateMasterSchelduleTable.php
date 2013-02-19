<?php

use Illuminate\Database\Migrations\Migration;

class CreateMasterSchelduleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('master', function($table) {
			$table->increments('id');
			$table->integer('district');
			$table->integer('team_id');
			$table->time('time');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('master');
	}

}