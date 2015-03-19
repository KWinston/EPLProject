<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Logs', function(Blueprint $table)
		{
			$table->increments('ID');
			$table->dateTime('LogDate');
			$table->integer('LogType');
			$table->integer('LogKey1');
			$table->integer('LogKey2');
			$table->integer('LogKey3');
			$table->integer('LogUserID');
			$table->string('LogMessage');
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
		Schema::table('Logs', function(Blueprint $table)
		{
			Schema::drop('Logs');						
		});
	}

}
