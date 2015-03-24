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
		/*
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'MNA-IT',
				'Name' => 'Cenetral Depot',
				'EPLAddress' => '7 Sir Winston Churchill Square, T5J 2V4',
				'PhoneNumber' => '0',
				'Latitude' => '53.5432',
				'LONGitude' => '-113.49'

			)
		);
		*/
		//DB::raw('update Branches(ID) values(0) where ID = 1');
		//DB::raw('UPDATE Branches SET ID = 0');
		
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'ABB',
				'Name' => 'Abbottsfield - Penny McKee Branch',
				'EPLAddress' => '3410 - 118 Avenue, T5W 0Z4',
				'PhoneNumber' => '780-496-7839',
				'Latitude' => '53.5704',
				'LONGitude' => '-113.392'

			)
		);
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'CAL',
				'Name' => 'Calder Branch',
				'EPLAddress' => '12522 - 132 Avenue, T5L 3P9',
				'PhoneNumber' => '780-496-7090',
				'Latitude' => '53.5922',
				'LONGitude' => '-113.539'
			)
		);
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'CPL',
				'Name' => 'Capilano Branch',
				'EPLAddress' => '201 Capilano Mall, 5004 - 98 Avenue,T6A 0A1',
				'PhoneNumber' => '780-496-1802',
				'Latitude' => '53.5379',
				'LONGitude' => '-113.42'
			)
		);
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'CSD',
				'Name' => 'Castle Downs Branch',
				'EPLAddress' => '106 Lakeside Landing, 15379 Castle Downs Rd, T5X 3Y7',
				'PhoneNumber' => '780-496-1804',
				'Latitude' => '53.6157',
				'LONGitude' => '-113.517'
			)
		);
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'CLV',
				'Name' => 'Clareview Branch',
				'EPLAddress' => '3808 - 139 Avenue, T5Y 3E7',
				'PhoneNumber' => '780-442-7471',
				'Latitude' => '53.6013',
				'LONGitude' => '-113.402'
			)
		);
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'HIG',
				'Name' => 'Highlands Branch',
				'EPLAddress' => '6710 - 118 Avenue, T5B 0P3',
				'PhoneNumber' => '780-496-1806',
				'Latitude' => '53.5706',
				'LONGitude' => '-113.445'
			)
		);
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'IDY',
				'Name' => 'Idylwylde Branch',
				'EPLAddress' => '68310 88 Avenue, T6C 1L1',
				'PhoneNumber' => '780-496-1808',
				'Latitude' => '53.5235',
				'LONGitude' => '-113.459'
			)
		);
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'JPL',
				'Name' => 'Jasper Place Branch',
				'EPLAddress' => '9010 - 156 Street, T5R 5X7',
				'PhoneNumber' => '780-496-1810',
				'Latitude' => '53.5232',
				'LONGitude' => '-113.59'
			)
		);
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'LHL',
				'Name' => 'Lois Hole Library',
				'EPLAddress' => '17650 69 Avenue, T5T 3X9',
				'PhoneNumber' => '780-442-0888',
				'Latitude' => '53.5038',
				'LONGitude' => '-113.626'
			)
		);
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'LON',
				'Name' => 'Londonderry Branch',
				'EPLAddress' => '110 Londonderry Mall, 137 Avenue &amp; 66 Street, T5C 3C8',
				'PhoneNumber' => '780-496-1814',
				'Latitude' => '53.6034',
				'LONGitude' => '-113.446'
			)
		);		
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'GMU',
				'Name' => 'MacEwan University Lending Machine',
				'EPLAddress' => '10700 - 104 Avenue, T5J 4S2',
				'PhoneNumber' => '0',
				'Latitude' => '53.5467',
				'LONGitude' => '-113.505'
			)
		);
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'MEA',
				'Name' => 'Meadows Branch',
				'EPLAddress' => '2704 - 17 Street, T6T 0X1',
				'PhoneNumber' => '780-442-7472',
				'Latitude' => '53.469',
				'LONGitude' => '-113.369'
			)
		);
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'MLW',
				'Name' => 'Mill Woods Branch',
				'EPLAddress' => '601 Mill Woods Town Centre, 2331 - 66 Street, T6K 4B5',
				'PhoneNumber' => '780-496-1818',
				'Latitude' => '53.4554',
				'LONGitude' => '-113.434'
			)
		);
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'RIV',
				'Name' => 'Riverbend Branch',
				'EPLAddress' => '460 Riverbend Square, Rabbit Hill Road &amp; Terwillegar Drive, T6R 2X2',
				'PhoneNumber' => '780-944-5311',
				'Latitude' => '53.4684',
				'LONGitude' => '-113.584'
			)
		);
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'SPW',
				'Name' => 'Sprucewood Branch',
				'EPLAddress' => '11555 - 95 Street, T5G 1L5',
				'PhoneNumber' => '780-496-7099',
				'Latitude' => '53.5667',
				'LONGitude' => '-113.487'
			)
		);
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'MNA',
				'Name' => 'Stanley A. Milner Library (Downtown)',
				'EPLAddress' => '7 Sir Winston Churchill Square, T5J 2V4',
				'PhoneNumber' => '780-496-7000',
				'Latitude' => '53.5432',
				'LONGitude' => '-113.49'
			)
		);
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'STR',
				'Name' => 'Strathcona Branch',
				'EPLAddress' => '8331 - 104 Street, T6E 4E9',
				'PhoneNumber' => '780-496-1828',
				'Latitude' => '53.5195',
				'LONGitude' => '-113.497'
			)
		);
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'WMC',
				'Name' => 'Whitemud Crossing Branch',
				'EPLAddress' => '145 Whitemud Crossing Shopping Centre, 4211 - 106 Street, T6J 6L7',
				'PhoneNumber' => '780-496-1822',
				'Latitude' => '53.4795',
				'LONGitude' => '-113.504'
			)
		);
		DB::table('Branches')->insert(
			array(
				'BranchMangerID' => '0',
				'BranchID' => 'WOO',
				'Name' => 'Woodcroft Branch',
				'EPLAddress' => '13420 - 114 Avenue, T5M 2Y5',
				'PhoneNumber' => '780-496-1830',
				'Latitude' => '53.5638',
				'LONGitude' => '-113.554'
			)
		);

		//DB::raw(INSERT INTO Branches (ID,BranchMangerID,BranchID,Name,EPLAddress,PhoneNumber,Latitude,LONGitude)
		//VALUES ('0','0','MNA-IT','Central Depot', '7 Sir Winston Churchill Square, T5J 2V4','0','53.5432','-113.49'));


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
