<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Settings', function(Blueprint $table)
		{
			$table->increments('ID');
			$table->string('Key',45);
			$table->string('Value',45);
		});

		//insert required date
		DB::table('Settings')->insert(
			array(
				'Key' => 'HomeLink',
				'Value' => '/'
			)
		);
		DB::table('Settings')->insert(
			array(
				'Key' => 'ShadowDays',
				'Value' => '1'
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
		Schema::drop('Settings');
	}

}
