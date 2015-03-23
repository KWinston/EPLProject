<?php
include('Globals/GlobalFunctions.php');

class RecieveKitController extends BaseController {

	public function index()
	{
        $branch = Branches::find(Session::get('branch'));

        $data = DB::select('SELECT
                              K.ID AS KitID, K.KitType, K.Name AS KitName, K.AtBranch, K.KitState, K.BarcodeNumber, K.Specialized,  K.SpecializedName,
                              B.ID as BookingID, B.ForBranch, B.StartDate, B.EndDate, B.ShadowStartDate, B.ShadowEndDate, B.Purpose,
                              KS.StateName,
                              KT.Name AS KitTypeName, KT.TypeDescription as KitTypeDesc
                              FROM Booking AS B
                                INNER JOIN Kits as K ON (K.ID = B.KitID)
                                  INNER JOIN KitTypes AS KT ON (KT.ID = K.KitType)
                                  INNER JOIN KitSTate AS KS ON (KS.ID = K.KitState)
                             WHERE now() BETWEEN DATE_ADD(B.ShadowStartDate, INTERVAL -1 DAY) AND B.ShadowEndDate
                                   AND B.ForBranch = ?
                                   AND B.ForBranch <> K.AtBranch
                                   ORDER BY BookingID
                                   ',
                                   array( $branch->ID));

		return CheckIfAuthenticated('members.receiveKitManagement',[ 'branch' => $branch,
                'selected_menu' => 'main-menu-receive', 'receiveKits' => $data, 'kitTypes' => KitTypes::all()], 'home.index', [], false);
	}

    public function findKit($bookingID)
    {
        $branch = Branches::find(Session::get('branch'));

        $receiveKits = DB::table('Booking')
            ->join('BookingDetails',
                'Booking.ID', '=', 'BookingDetails.BookingID')
            ->join('Kits',
                'Booking.KitID', '=', 'Kits.ID')
            ->join('KitState',
                'KitState.ID', '=', 'Kits.KitState')
            ->join('KitTypes',
                'KitTypes.ID', '=', 'Kits.KitType')
            ->join('Branches', function($join)
            {
                $join->on('Kits.AtBranch', '=', 'Branches.ID');
            })
                        
            ->where('Booking.ForBranch', $branch->ID)
            ->where('Booking.ID', $bookingID)
            ->select('Booking.ID As BookingID', 'Booking.StartDate', 'Booking.EndDate', 'Booking.KitID As KitID',
                'BookingDetails.*', 'Kits.AtBranch', 'Kits.KitState', 'Kits.KitDesc', 'KitState.StateName',
                'KitTypes.Name', 'Branches.Name As BName', 'Branches.ID As BranchesID')
            ->get();

        $perPage = 5;
        $currentPage = Input::get('page', 1) - 1;
        $pagedData = array_slice($receiveKits, $currentPage * $perPage, $perPage);
        $data = Paginator::make($pagedData, count($receiveKits), $perPage);

        return CheckIfAuthenticated('members.receivekit',[ 'branch' => $branch,
                'selected_menu' => 'main-menu-receive', 'receiveKits' => $data], 'home.index', [], false);
    }

    public function confirmReceive()
    {
        if(!Request::ajax())
            return "not a json request";

        $post = Input::except('ID');

        $stat = DB::table('Kits')
            ->where('id', $post['KitID'])
            ->update(array(
                'AtBranch' => $post['ForBranch'],
                'KitState' => '1',
            ));

        return Response::json(array(
            'success' => $stat = 1 ? true : false
        ), 200);
    }

        // Show the types Edit form
    public function edit($BookingID)
    {
        $booking = Booking::findOrFail($BookingID);
        return View::make("members.receiveKitEdit", ['booking' => $booking]);
    }

        // ---------------------------------------------------------------------------------------------------
    //
    public function store()
    {
        //print dd(Input::All());

        $kit = Kits::findOrFail(Input::get('ID'));
        foreach ($kit->contents as $content)
        {
            if (Input::has('isMissing_'.$content->ID) &&
                Input::get('isMissing_'.$content->ID) == '1' &&
                $content->MissingLogID == null) 
            {
                $message = Input::get('MissingID_'.$content->ID);
                $logID = Logs::MissingReport($kit->KitType, $kit->ID, $content->ID, $message);
                $content->MissingLogID = $logID;
                $saveme = $logID;
            }

            if (Input::has('isDamaged_'.$content->ID) &&
                Input::get('isDamaged_'.$content->ID) == '1' &&
                $content->DamagedLogID == null) 
            {
                $message = Input::get('DamagedID_'.$content->ID);
                $logID = Logs::DamageReport($kit->KitType, $kit->ID, $content->ID, $message);
                $content->DamagedLogID = $logID;
            }
            $content->save();
        }
        if (Input::has('LogMessage') &&
           strlen(Input::get('LogMessage')) > 0)
        {
            $message = Input::get('LogMessage');
            $logNote = Logs::Note($kit->KitType, $kit->ID, $message);
        }
        return print dd($saveme);
    }

    // ---------------------------------------------------------------------------------------------------
    //
    public function create()
    {
           $kitType = KitTypes::create(['Name' => 'newType', 'TypeDescription' => '']);
        return $kitType;
    }

    // ---------------------------------------------------------------------------------------------------
    //
    public function destroy($kitTypeID)
    {
        // This Shall be fun!
        // We have to deconstruct the types based on the forign key dependencys
        // First iterate all the kits, for each kit remove all contents,
        // and then all bookings (and all booking details)
        // then finally we can remove the kit type and then all the logs for that
        // kit type.
        foreach(Kits::where('KitType', '=', $kitTypeID)->get() as $kit)
        {
            foreach(KitContents::where("KitID", '=', $kit->ID)->get() as $content)
            {
                KitContents::destroy($content->ID);
            }

            foreach(Booking::where("KitID", '=', $kit->ID)->get() as $booking)
            {
                foreach(BookingDetails::where("BookingID", '=', $booking->ID)->get() as $detail)
                {
                    BookingDetails::destroy($detail->ID);
                }
                Booking::destroy($booking->ID);
            }
            
            Kits::destroy($kit->ID);
        }
        KitTypes::destroy($kitTypeID);
        // Do the logs last, as all the deletes will log the changes of deleting the bits.
        Logs::where('LogKey1', '=', $kitTypeID)->delete();

        return "OK";
    }
}