<?php
include('Globals/GlobalFunctions.php');

class KitContentsController extends BaseController
{
    // ---------------------------------------------------------------------------------------------------
    // Show the kit managment page

    public function contents($kitID)
    {
        return CheckIfAuthenticated('kit.kitContents',
                                    ['kitContents' => Kits::find($kitID)->contents],
                                    'home.index',
                                    [],
                                    true);
    }

    // ---------------------------------------------------------------------------------------------------
    // Show the The Kit Edit form
    public function show($kitID)
    {

    }

    public function edit($kitID)
    {
         return View::make("kit.kitCointents", ['kitID' => $kitID, 'contents' => Kits::findOrFail($kitID)->contents]);
    }


    public function store()
    {
        $kit = Kits::findOrFail(Input::get('ID'));
        foreach ($kit->contents as $cont)
        {
            if ($cont->DamagedLogID == null && Input::has('DamagedMsg_' . $cont->ID))
            {
                $cont->DamagedLogID = Logs::DamageReport($kit->KitType, $kit->ID, $cont->ID, base64_decode(Input::get('DamagedMsg_' . $cont->ID)));
            }
            if ($cont->MissingLogID == null && Input::has('MissingMsg_' . $cont->ID))
            {
                $cont->MissingLogID = Logs::MissingReport($kit->KitType, $kit->ID, $cont->ID, base64_decode(Input::get('MissingMsg_' . $cont->ID)));
            }
            $cont->save();
        }
        return "OK";
    }


}
