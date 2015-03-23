<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitStateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('KitState', function(Blueprint $table)
		{
			$table->increments('ID');
			$table->string('StateName');
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
		Schema::table('KitState', function(Blueprint $table)
		{
			Schema::drop('KitState');			
		});
	}

}
