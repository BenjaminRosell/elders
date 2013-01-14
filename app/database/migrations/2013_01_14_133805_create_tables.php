<?php

use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('username');
			$table->string('password');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email')->unique;
			$table->string('phone');
			$table->boolean('reminder')->nullable;
			$table->timestamps();
		});

		Schema::create('teams', function($table) {
			$table->increments('id');
			$table->integer('lead');
			$table->integer('companion');
			$table->integer('steward');
			$table->timestamps();
		});

		Schema::create('homes', function($table) {
			$table->increments('id');
			$table->integer('team_id');
			$table->text('name');
			$table->text('phone_number');
			$table->text('email');
			$table->text('address');
			$table->timestamps();
		});

		Schema::create('visits', function($table) {
			$table->increments('id');
			$table->integer('team_id');
			$table->integer('family_id');
			$table->integer('visited');
			$table->date('month');
			$table->text('status');
			$table->text('message');
			$table->text('issues');
			$table->date('visit_date');
			$table->date('report_date');
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
		Schema::drop('users');
		Schema::drop('teams');
		Schema::drop('homes');
		Schema::drop('visits');
	}

}