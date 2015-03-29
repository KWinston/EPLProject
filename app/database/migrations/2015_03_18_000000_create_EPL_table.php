<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEPLTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // ==================== Kit Types
        Schema::create('KitTypes', function(Blueprint $table)
        {
            $table->increments('ID');
            $table->string('Name');
            $table->string('TypeDescription')->nullable();
            $table->timestamps();
        });
        DB::table('KitTypes')->insert(
            array(
                'Name' => '**UNDEFINED**',
                'TypeDescription' => 'The root System Type.'
            )
        );

        DB::statement("UPDATE EPL_KIT_DB.KitTypes set ID=0 where ID=1;");
        DB::statement("ALTER TABLE EPL_KIT_DB.KitTypes AUTO_INCREMENT=1;");

        // ==================== Kit State
        Schema::create('KitState', function(Blueprint $table)
        {
            $table->increments('ID');
            $table->string('StateName')->nullable();
            $table->timestamps();
        });

        DB::table('KitState')->insert(
            array(
                'StateName' => 'At Branch'
            )
        );

        DB::table('KitState')->insert(
            array(
                'StateName' => 'In Transit'
            )
        );

        DB::table('KitState')->insert(
            array(
                'StateName' => 'Unavailable'
            )
        );
        // ==================== Settings
        Schema::create('Settings', function(Blueprint $table)
        {
            $table->increments('ID');
            $table->string('Key',45);
            $table->string('Value',45)->default(null);
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


        // ==================== Log Type
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


        // ==================== Branches
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

        DB::statement("UPDATE EPL_KIT_DB.Branches set ID=0 where ID=1;");
        DB::statement("ALTER TABLE EPL_KIT_DB.Branches AUTO_INCREMENT=1;");
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

        // ==================== users
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('realname');
            $table->string('email')->nullable();
            $table->integer('home_branch')->unsigned()->default(0);
            $table->tinyInteger('is_admin')->default(0);
            $table->string('remember_token')->nullable();
            $table->timestamps();
        });

        Schema::table('users', function(Blueprint $table)
        {
            $table->foreign('home_branch')->references('ID')->on('Branches');
        });

        DB::table('users')->insert(
            array(
                'username' => 'user',
                'password' => Hash::make('user'),
                'realname' => 'User',
                'email' => 'EPLuser@mailinator.com',
                'home_branch' => '0',
                'is_admin' => '1',
                'remember_token' => 'NULL'
            )
        );

        DB::table('users')->insert(
            array(
                'username' => 'user2',
                'password' => Hash::make('user'),
                'realname' => 'User',
                'email' => 'EPLuser2@mailinator.com',
                'home_branch' => '0',
                'is_admin' => '0',
                'remember_token' => 'NULL'
            )
        );



        // ==================== Kits
        Schema::create('Kits', function(Blueprint $table)
        {
            $table->increments('ID');
            $table->integer('KitType')->unsigned();
            $table->string('Name');
            $table->integer('AtBranch')->unsigned();
            $table->tinyInteger('Available')->default(1);
            $table->integer('KitState')->unsigned();
            $table->string('KitDesc');
            $table->string('BarcodeNumber',45)->default('31221');
            $table->tinyInteger('Specialized')->default(0);
            $table->string('SpecializedName')->nullable();
            $table->timestamps();
        });
        Schema::table('Kits', function(Blueprint $table)
        {
            $table->foreign('AtBranch')->references('ID')->on('Branches');
            $table->foreign('KitState')->references('ID')->on('KitState');
            $table->foreign('KitType')->references('ID')->on('KitTypes');

        });
        // ==================== Kit Contents
        Schema::create('KitContents', function(Blueprint $table)
        {
            $table->increments('ID');
            $table->integer('KitID')->unsigned();
            $table->string('Name');
            $table->string('SerialNumber')->nullable();
            $table->integer('Damaged')->default(0);
            $table->tinyInteger('Missing')->default(0);
            $table->timestamps();
        });
        Schema::table('KitContents', function(Blueprint $table)
        {
            $table->foreign('KitID')->references('ID')->on('Kits');

        });

        // ==================== Booking
        Schema::create('Booking', function(Blueprint $table)
        {
            $table->increments('ID');
            $table->integer('KitID')->unsigned();
            $table->integer('ForBranch')->unsigned();
            $table->dateTime('StartDate');
            $table->dateTime('EndDate');
            $table->dateTime('ShadowStartDate');
            $table->dateTime('ShadowEndDate');
            $table->string('Purpose')->nullable();
            $table->dateTime('updated_at');
            $table->dateTime('created_at');
        });
        Schema::table('Booking', function(Blueprint $table)
        {
            $table->foreign('ForBranch')->references('ID')->on('Branches');
            $table->foreign('KitID')->references('ID')->on('Kits');
        });

        // ==================== Logs
        Schema::create('Logs', function(Blueprint $table)
        {
            $table->increments('ID');
            $table->dateTime('LogDate');
            $table->integer('LogType')->unsigned();
            $table->integer('LogKey1');
            $table->integer('LogKey2')->nullable();
            $table->integer('LogKey3')->nullable();
            $table->integer('LogUserID')->unsigned();
            $table->string('LogMessage');
            $table->timestamps();
        });
        Schema::table('Logs', function(Blueprint $table)
        {
            $table->foreign('LogType')->references('ID')->on('LogType');
            $table->foreign('LogUserID')->references('id')->on('users');
        });


        // ==================== Booking Details
        Schema::create('BookingDetails', function(Blueprint $table)
        {
            $table->increments('ID');
            $table->integer('BookingID')->unsigned();
            $table->integer('UserID')->unsigned()->nullable()->defult(null);
            $table->string('Email')->nullable();
            $table->tinyInteger('Booker')->default('1');
            $table->dateTime('updated_at');
            $table->dateTime('created_at');
        });
        Schema::table('BookingDetails', function(Blueprint $table)
        {
            $table->foreign('BookingID')->references('ID')->on('Booking');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * Drop tables in revers order.
     * The layers at top are depended on the ones below, so drop them first.
     */
    public function down()
    {
        Schema::drop('BookingDetails');

        Schema::drop('Booking');
        Schema::drop('KitContents');
        Schema::drop('Logs');

        Schema::drop('Kits');
        Schema::drop('users');

        Schema::drop('Branches');

        Schema::drop('LogType');
        Schema::drop('KitTypes');
        Schema::drop('Settings');
        Schema::drop('KitState');
    }

}
