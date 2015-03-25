<?php

use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class email extends ScheduledCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'command:email';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Automated Email Notifications';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * When a command should run
	 *
	 * @param Scheduler $scheduler
	 * @return \Indatus\Dispatcher\Scheduling\Schedulable
	 */
	public function schedule(Schedulable $scheduler)
	{
		//return $scheduler->daily()->hours(5)->minutes(30);
		return $scheduler->everyMinutes(1);
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		date_default_timezone_set('America/Edmonton');
		$date = date('m/d/Y h:i:s a', time());
		$tomorrow = date('Y-m-d', strtotime($date . " + 1 days"));
		print($tomorrow);

		$query = 
				"select B.ShadowStartDate as 'ShipDay',".
				"	BD.Email as 'Email',".
				"	BR.BranchID as 'BranchCode',".
				"	BR.Name as 'BranchName',".
				"	K.Name as 'KitName',".
				"	K.BarcodeNumber as 'Barcode'".
				"from Booking as B". 
   				"   inner join Kits as K". 
         		"       on B.KitID = K.ID".
    			"	inner join BookingDetails as BD".
      			"		on BD.BookingID = B.ID".    
   				"	inner join Branches as BR".
      			"		on B.ForBranch = BR.ID".
				" where ('".$tomorrow."' between B.ShadowStartDate and B.StartDate)".
				"	and BD.Email is not null";

        $bookings = DB::select(DB::raw($query));
        foreach($bookings as $booking)
        {
    		$data = array(
    			'Barcode' => $booking->Barcode,
    			'KitName' => $booking->KitName,
    			'ShipDay' => date_format(date_create($booking->ShipDay), 'M d, Y'),
    			'Branch' => $booking->BranchName,
    			'BranchCode' => $booking->BranchCode,
    			'Email' => $booking->Email
    		);

			Mail::send('emails.ship_kit', $data, function($message) use ($data)
			{
			    $message->to($data['Email']);
			});
		}
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
