<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('LogType', function(Blueprint $table)
		{
			$table->increments('ID');
			$table->string('Name');
			$table->timestamps();
		});

		DB::table('LogType')->insert(
			array(
				'Name' => 'Damage Report'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Missing Report'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Note'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Kit Created'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Kit Edit'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Kit Deleted'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Kit Type Created'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Kit Type Edited'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Kit Deleted'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Kit Contents Added'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Kit Contents Edited'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Kit Contents Removed'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Booking Request'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Booking Cancelled'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Booking Edited'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Kit Transfer Shipped'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Kit Transfer Recieved'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Booking Detail Added'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Booking Detail Edit'
			)
		);
		DB::table('LogType')->insert(
			array(
				'Name' => 'Booking Detail Deleted'
			)
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('LogType');
	}

}
