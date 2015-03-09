<?php
include('Globals/GlobalFunctions.php');

class UsersController extends BaseController
{
    // ---------------------------------------------------------------------------------------------------
    // Show the Branches managment page
    public function index()
    {
        return CheckIfAuthenticated('users.userManagment',
            ['selected_menu' => 'main-menu-administration',
            'selected_admin_menu' => 'admin-menu-manage-users',
            'users' => User::all(),
            'branches' => Branches::all()
            ], 'home.index', [], true);

    }


    // ---------------------------------------------------------------------------------------------------
    // Get the edit form for this user
    public function edit($userID)
    {
        $branches = array();
        foreach(Branches::all() as $branch)
        {
            $branches[$branch->ID] = "(" . $branch->BranchID . ") " . $branch->Name;
        }
        return View::make("users.editUser", ['user' => User::find($userID), 'branches' => $branches]);
    }

    // ---------------------------------------------------------------------------------------------------
    // Store changes to the user
    public function store()
    {
        $userID = Input::get('id');
        $user = User::find($userID);
        $user->is_admin = false; // stupid checkboxes not submitting if unchecked.
        $user->fill(Input::all());
        $user->save();
        $res = array();
        $res['id'] = $user->id;
        $res['username'] = htmlspecialchars($user->username);
        $res['realname'] = htmlspecialchars($user->realname);
        $res['email'] = htmlspecialchars($user->email);
        $res['home_branch'] = "(" . $user->homeBranch->BranchID . ") ". $user->homeBranch->Name;
        $res['is_admin'] = $user->is_admin;
        return json_encode($res);
    }
}
