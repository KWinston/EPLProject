<?php
include('Globals/GlobalFunctions.php');

clASs OverviewKitCONtroller extends BaseController {

	functiON index()
	{
        $data = DB::select( 'SELECT K.ID AS KitID, KT.Name AS KitType, K.Name AS KitName, B.BranchID AS BranchName, KS.StateName AS KitState, BK.StartDate, B2.BranchID AS ForBranchName, count(BK.ID) AS BookingCount
                              FROM kits AS K
                                INNER JOIN KitTypes AS KT ON (KT.ID = K.KitType)
                                INNER JOIN Branches AS B ON (B.ID = K.AtBranch)
                                INNER JOIN KitState AS KS ON (KS.ID = K.KitState)
                                LEFT JOIN  Booking AS BK ON (BK.KitID = K.ID AND BK.StartDate > now())
                                    LEFT JOIN Branches AS B2 ON (B2.ID = BK.ForBranch)
                              WHERE K.Available = true
                              GROUP BY K.ID, KT.Name, K.Name, B.Name, B.BranchID
                              ORDER BY KT.Name, K.Name, BK.StartDate DESC
                            ;');
		return CheckIfAuthenticated('members.overviewkit',
            [  'selected_menu' => 'main-menu-overview',
               'data' => $data
            ], 'home.index', [], false);
	}
}
