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
		Schema::create('goals', function($table) {
			$table->increments('id');
			$table->integer('home_id');
			$table->integer('completed');
			$table->date('date_due');
			$table->date('date_completed')->nullable();
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
		Schema::drop('goals');
	}

}