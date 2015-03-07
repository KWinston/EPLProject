<?php
include('Globals/GlobalFunctions.php');

class KitTypesController extends BaseController
{

    // ---------------------------------------------------------------------------------------------------
    // Show the types managment page
    public function index()
    {

        return CheckIfAuthenticated('kit.kitTypeManagment',
            ['selected_menu' => 'main-menu-administration',
            'selected_admin_menu' => 'admin-menu-manage-kit-types',
            'kitTypes' => KitTypes::all()
            ], 'home.index', [], true);
    }

    // ---------------------------------------------------------------------------------------------------
    // Show the types Edit form
    public function edit($kitTypeID)
    {
        $kitType = KitTypes::find($kitTypeID);
        return View::make("kit.kitTypeEdit", ['kitType' => $kitType]);
    }

    // ---------------------------------------------------------------------------------------------------
    //
    public function store()
    {
        $id = Input::get('ID');
        $kitType = KitTypes::find($id);
        $kitType->fill(Input::all());
        $kitType->save();
        return "OK";
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
