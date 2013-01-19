<?php

use Illuminate\Database\Migrations\Migration;

class CreateInterviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interviews', function($table) {
			$table->increments('id');
			$table->integer('lead');
			$table->integer('companion');
			$table->dateTime('date');
			$table->text('notes')->nullable();
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