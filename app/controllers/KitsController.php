<?php
include('Globals/GlobalFunctions.php');

class KitsController extends BaseController
{
    // ---------------------------------------------------------------------------------------------------
    // Show the kit managment page
    public function index()
    {
        return CheckIfAuthenticated('kit.kitManagment',
                                    ['selected_menu' => 'main-menu-administration', 'selected_admin_menu' => 'admin-menu-manage-kits'],
                                    'home.index',
                                    [],
                                    true);

    }

    // ---------------------------------------------------------------------------------------------------
    // Show the The Kit Edit form
    public function show($kitID)
    {
        return "Show Kit edit form";
    }

    public function edit($kitID)
    {
        $kit = Kits::find($kitID);
        $kitTypes = array();
        foreach (KitTypes::all() as $row)
        {
            $kitTypes[$row->ID] = $row->Name;
        }
        $kitStates = array();
        foreach (KitState::all() as $row)
        {
            $kitStates[$row->ID] = $row->StateName;
        }
        $branches = array();
        foreach (Branches::all() as $row)
        {
            $branches[$row->ID] = $row->BranchID . " - " . $row->Name;
        }
        return View::make('kit.kitEdit', array('kit'=>$kit, 'kitTypes'=>$kitTypes, 'kitStates' => $kitStates, 'branches'=>$branches));
    }


    public function store()
    {
        $inp = Input::all();
        $id = $inp['ID'];
        if (!isset($inp['Available']))
        {
            $inp['Available'] = 0;
        }
        $kit = Kits::find($id);
        $t = json_encode($kit);
        // Check boxes are only sent if checked, so we set them to false, and if they are in the input then we update them.
        foreach($inp as $key => $value)
        {

            if (isset($kit[$key]) && ($kit[$key] != $inp[$key]))
            {
                $kit[$key] = $value;
                Logs::KitEdit($kit->KitType, $kit->ID, $key, $kit[$key], $value);
            }
        }
        $kit->save();
        // Format a record for a individual
        $res = $this->makeJTreeKitRecord($kit);
        return $res;
    }

    public function destroy($kitID)
    {
        $kit = Kits::find($kitID);
        Logs::KitDelete($kit->KitType, $kit->ID);
        $kit->delete();
    }

    public function create()
    {
        $kit = Kits::create(array(
            'KitType' => 0,
            'AtBranch' => 0,
            'KitState' => 1,
            'Available' =>0 ,
            'Name' => "New Kit Name",
            'KitDesc' => "Place a description of the contents of this kit here. "
            ));
        Logs::KitCreated($kit->KitType, $kit->ID);

        $res = $this->makeJTreeKitRecord($kit);
        return $res;
    }


    protected function makeJTreeKitRecord($kit)
    {
        $key = 'type_' . $kit->KitType;
        $n = $kit->Name;
        if (((int)$kit->Specialized) == 1)
        {
            $n = $n . ' + ' . $kit->SecializedName;
        }

        $res = array(
                      'type' => 'KIT',
                      'id' => 'kit_' . $kit->ID,
                      'KitID' => $kit->ID,
                      'KitTypeID' => $kit->type->ID,
                      'text' => $n,
                      'parent' => $key,
                      'state' => array( 'opened' => false, 'disabled' => false, 'selected' => false),
                      'children' => array()
                    );
        return json_encode($res);
    }

}
