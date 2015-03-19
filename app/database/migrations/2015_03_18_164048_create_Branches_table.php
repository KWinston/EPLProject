<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Branches', function(Blueprint $table)
		{
			$table->increments('ID');
			$table->integer('BranchMangerID');
			$table->string('BranchID',45);
			$table->string('Name');
			$table->string('EPLAddress');
			$table->string('PhoneNumber');
			$table->float('Latitude');
			$table->float('LONGitude');
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
		Schema::drop('Branches');			
	}

}
