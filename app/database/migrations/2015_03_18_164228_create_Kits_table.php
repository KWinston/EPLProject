<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Kits', function(Blueprint $table)
		{
			$table->increments('ID');
			$table->integer('KitType');
			$table->string('Name');
			$table->integer('AtBranch');
			$table->tinyInteger('Available');
			$table->integer('KitState');
			$table->string('KitDesc');
			$table->string('BarcodeNumber',45);
			$table->tinyInteger('Specialized');
			$table->string('SpecializedName');
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
		Schema::drop('Kits');			
	}

}
