<?php

class HomeController extends BaseController
{
    public function index()
    {
        $branch = Branches::find(Session::get('branch'));
        // If the session is not set, default to the IT depot
        if (!isset($branch))
        {
            $branch = Branches::find(0);
        }
        return View::make('home', array(
            'branch_name' => $branch->Name,
            'selected_menu' => 'main-menu-home'
        ));
    }

    public function getInventory()
    {
        $branch = Branches::find(Session::get('branch'));
        // If the session is not set, default to the IT depot
        if (!isset($branch))
        {
            $branch = Branches::find(0);
        }
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
                            UNION
                            SELECT
                              K.ID AS KitID, K.KitType, K.Name AS KitName, K.AtBranch, K.KitState, K.BarcodeNumber, K.Specialized,  K.SpecializedName,
                              B.ID as BookingID, B.ForBranch, B.StartDate, B.EndDate, B.ShadowStartDate, B.ShadowEndDate, B.Purpose,
                              KS.StateName,
                              KT.Name AS KitTypeName, KT.TypeDescription as KitTypeDesc
                              FROM Booking AS B
                                INNER JOIN Kits as K ON (K.ID = B.KitID)
                                  INNER JOIN KitTypes AS KT ON (KT.ID = K.KitType)
                                  INNER JOIN KitSTate AS KS ON (KS.ID = K.KitState)
                             WHERE now() BETWEEN DATE_ADD(B.ShadowStartDate, INTERVAL -1 DAY) AND B.ShadowEndDate
                                   AND K.AtBranch = ?
                                   AND K.KitState = 1
                                   AND B.ForBranch <> K.AtBranch
                            UNION
                            SELECT
                              K.ID AS KitID, K.KitType, K.Name AS KitName, K.AtBranch, K.KitState, K.BarcodeNumber, K.Specialized,  K.SpecializedName,
                              "", "", "", "", "", "", "",
                              KS.StateName,
                              KT.Name AS KitTypeName, KT.TypeDescription as KitTypeDesc
                              FROM Kits AS K
                                INNER JOIN KitTypes AS KT ON (KT.ID = K.KitType)
                                INNER JOIN KitSTate AS KS ON (KS.ID = K.KitState)
                                LEFT JOIN Booking AS B ON (B.KitID = K.ID AND now() BETWEEN DATE_ADD(B.ShadowStartDate, INTERVAL -1 DAY) AND B.ShadowEndDate)
                             WHERE  B.ID is null
                                    AND K.KitState = 1
                                    AND K.AtBranch = ?
                             ORDER BY KitID
                            ',
                            array( $branch->ID, $branch->ID, $branch->ID));

        $allBranches = array();
        foreach(Branches::all() as $brnch)
        {
            $allBranches[$brnch->ID] = array( 'ID' => $brnch->ID,
                                            'BranchID' => $brnch->BranchID,
                                            'Name' => $brnch->Name,
                                            'Address' => $brnch->EPLAddress,
                                            'PhoneNumber' => $brnch->PhoneNumber
                                            );
        }
        //get today's date
        $res = array();
        $res['foo'] = Session::get('branch');
        $res['data'] = $data;
        $res['branches'] = $allBranches;
        $res['branch_ID'] =$branch->ID;
        $res['branch_BranchID'] =$branch->BranchID;
        $res['branch_name'] = $branch->Name;
        return json_encode($res);
    }
}
