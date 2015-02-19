<?php
include('Globals/GlobalFunctions.php');

class BookKitController extends BaseController {

    public function index()
    {
        return CheckIfAuthenticated('members.bookkit',['treeData' =>  GetKitTypeTreeData() ], 'home.index', [], false);
    }
}
