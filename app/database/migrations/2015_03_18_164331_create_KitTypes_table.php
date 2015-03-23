<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('KitTypes', function(Blueprint $table)
		{
			$table->increments('ID');
			$table->string('Name');
			$table->string('TypeDescription');
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
		Schema::table('KitTypes', function(Blueprint $table)
		{
			Schema::drop('KitTypes');			
		});
	}

}
