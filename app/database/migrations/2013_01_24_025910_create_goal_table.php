<?php

use Illuminate\Database\Migrations\Migration;

class CreateGoalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interviews', function($table) {
			$table->increments('id');
			$table->integer('home_id');
			$table->integer('completed');
			$table->date('date_due');
			$table->date('date_completed');
			$table->text('name');
			$table->text('description');
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
		Schema::drop('interviews');
	}

}