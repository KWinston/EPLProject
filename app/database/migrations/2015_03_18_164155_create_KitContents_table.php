<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('KitContents', function(Blueprint $table)
		{
			$table->increments('ID');
			$table->integer('KitID');
			$table->string('SerialNumber');
			$table->tinyInteger('Damaged');
			$table->tinyInteger('Missing');
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
		Schema::drop('KitContents');			
	}

}
