<?php

use Illuminate\Database\Migrations\Migration;

class EditUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('visits', function($table)
		{
		    $table->integer('lead_id');
		    $table->integer('companion_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('visits', function($table)
		{
		    $table->dropColumn('lead_id');
		    $table->dropColumn('companion_id');
		});
	}

}