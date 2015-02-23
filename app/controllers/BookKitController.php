<?php
include('Globals/GlobalFunctions.php');

class BookKitController extends BaseController {

    public function index()
    {
        return CheckIfAuthenticated('members.bookkit', ['treeData' =>  GetKitTypeTreeData() ], 
            'home.index', [], false);
    }

    public function get_shadow_days()
    {
    	if(!Request::ajax())
            return "not a json request";

        $data = Input::all();
        

        if($data['ID'] == "*")
            $branch = 'ALL';    // get all information
        else
        {
            $branch = Branches::select('BranchID')
                ->where('ID', '=', $data['ID'])
                ->pluck('BranchID');
            $branch =  str_replace(['EPL'], [''], $branch);
        }

        $url = str_replace([':FORMAT', ':BRANCH'], ['xml', $branch], API_URL());

        return xmlToJSON($url);
    }
}
