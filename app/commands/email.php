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
		return $scheduler->daily()->hours(5)->minutes(30);
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$date = date_format(date(), 'Y/m/d');
		$tomorrow = date('Y-m-d',strtotime($date . "+ 1 days"));

		$query = 
                "select * ".
                "from Booking as B ".
                "inner join Kits as K ".
                    "on B.KitID = K.ID ".
                "where ('".$tomorrow."' between B.ShadowStartDate and B.StartDate)";

        $bookings = DB::select(DB::raw($query));

        foreach($bookings as $booking)
        {
        	$branch = Branches::find($booking->ForBranch);
        	$emailList = BookingDetails::where("BookingID", $booking->ID)->get();
        	foreach ($emailList as $email)
        	{
				// send email notifications
        		$data = array(
        			'Barcode' => $booking->BarcodeNumber,
        			'KitName' => $booking->Name,
        			'MaxShipDay' => $booking->$booking->ShadowStartDate,
        			'Branch' => $branch->BranchID
        		);
				Mail::send('emails.ship_kit', $data, function($message)
				{
				    $message->from('foo@example.com', 'EPL Kit Manager');
				    $message->to($email->Email);
				});
			}
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
