<?php
include('Globals/GlobalFunctions.php');

class KitContentsController extends BaseController
{
    // ---------------------------------------------------------------------------------------------------
    // Show the kit managment page
    public function index()
    {
        return "list of kit items.";

    }

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
    }


    public function store()
    {
    }

    public function destroy($kitID)
    {
    }

    public function create()
    {
    }

}
