<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('BookingDetails', function(Blueprint $table)
		{
			$table->increments('ID');
			$table->integer('BookingID');
			$table->integer('UserID');
			$table->string('Email');
			$table->tinyInteger('Booker');
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
		Schema::drop('BookingDetails');	
	}

}
