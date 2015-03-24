<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username')->unique();
			$table->string('password');
			$table->string('realname');
			$table->string('email')->unique();
			$table->string('home_branch');
			$table->tinyInteger('is_admin');
			$table->string('remember_token');
			$table->timestamps();
		});
		DB::table('users')->insert(
			array(
				'username' => 'user',
				'password' => 'root',
				'realname' => 'User',
				'email' => 'user@user.com',
				'home_branch' => '3',
				'is_admin' => '1',
				'remember_token' => 'NULL'
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
		Schema::drop('users');
	}

}
