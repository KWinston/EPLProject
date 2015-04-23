<?php
include('Globals/GlobalFunctions.php');

clASs OverviewKitCONtroller extends BaseController {

    functiON index()
    {
        $data = DB::select( 'SELECT
                                K.ID AS KitID,
                                KT.Name AS KitType,
                                KT.TypeDescription as TypeDescription,
                                K.Name AS KitName,
                                K.KitDesc as KitDescription,
                                B.BranchID AS BranchID,
                                B.Name AS BranchName,
                                B.PhoneNumber AS BranchPhone,
                                B.EPLAddress AS BranchAddress,
                                KS.StateName AS KitState,
                                BK.ID AS BookingID,
                                BK.StartDate,
                                B2.BranchID AS ForBranchID,
                                B2.Name AS ForBranchName,
                                B2.PhoneNumber AS ForBranchPhone,
                                U.id AS UserID,
                                U.realname AS UserName,
                                U.email AS UserEmail,
                                count(BK3.ID) AS BookingCount
                              FROM Kits AS K
                                INNER JOIN KitTypes AS KT ON (KT.ID = K.KitType)
                                INNER JOIN Branches AS B ON (B.ID = K.AtBranch)
                                INNER JOIN KitState AS KS ON (KS.ID = K.KitState)
                                LEFT JOIN  Booking AS BK ON (BK.ID = (SELECT BK2.ID FROM Booking AS BK2 WHERE BK2.StartDate > now() AND BK2.KitID = K.ID ORDER BY BK2.StartDate LIMIT 1))
                                    LEFT JOIN Branches AS B2 ON (B2.ID = BK.ForBranch)
                                    LEFT JOIN BookingDetails AS BD ON (BD.BookingID = BK.ID AND BD.Booker = TRUE)
                                        LEFT JOIN users AS U ON (U.id = BD.UserID)
                                LEFT JOIN  Booking AS BK3 ON (BK3.KitID = K.ID AND BK3.StartDate > now())

                              WHERE K.Available = true
                              GROUP BY K.ID, KT.Name,KT.typeDescription, K.Name, K.KitDesc, B.Name, B.BranchID
                              ORDER BY KT.Name, K.Name, BK.StartDate
                            ;
                            ');
        return CheckIfAuthenticated('members.overviewkit',
            [  'selected_menu' => 'main-menu-overview',
               'data' => $data
            ], 'home.index', [], false);
    }
}
