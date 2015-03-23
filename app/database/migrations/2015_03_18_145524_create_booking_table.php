<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Booking', function(Blueprint $table)
		{
			$table->increments('ID');
			$table->integer('KitID');
			$table->integer('ForBranch');
			$table->dateTime('StartDate');
			$table->dateTime('EndDate');
			$table->dateTime('ShadowStartDate');
			$table->dateTime('ShadowEndDate');
			$table->string('Purpose');
			$table->dateTime('updated_at');
			$table->dateTime('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Booking');
	}

}
