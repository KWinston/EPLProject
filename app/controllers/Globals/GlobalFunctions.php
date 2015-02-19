<?php
function CheckIfAuthenticated($page, $pageParams, $reroute, $rerouteParams, $isAdminPage)
{
	if(!Auth::check())
		return Redirect::route($reroute);

	$adminPage = $isAdminPage ? 1 : 0;
	if (!(Auth::user()->is_admin >= $adminPage))
		return Redirect::route($reroute, $rerouteParams);

	return View::make($page, $pageParams);
}

//------------------------------------------------------------------------------
// This functions will build a JSON string that contains the types with there
// nested kits suitable for the Jtree control in a parent Orientated format.
function GetKitTypeTreeData()
{
    $data = array();
    $nodeState = array ( 'opened' => false, 'disabled' => false, 'selected' => false);
    $kitTypes = KitTypes::all();
    $kits = Kits::all();
    $children = array();
    foreach($kitTypes as $kitType)
    {
        $key = 'type_' . $kitType->ID;

        $childNodes = array();
        foreach($kitType->kits as $kit)
        {
            $key = 'type_' . $kit->KitType;
            $n = $kit->Name;
            if (((int)$kit->Specialized) == 1)
            {
                $n = $n . ' + ' . $kit->SecializedName;
            }
            array_unshift($childNodes, array('id' => 'kit_' . $kit->ID, 'text' => $n , 'parent' => $key, 'state' => $nodeState, 'children' =>array()));
        }
        $childNodes = array_values(array_sort($childNodes, function($value) { return $value['text'];}));
        array_unshift($children, array('id' => $key, 'text' => $kitType->Name , 'state' => $nodeState, 'children' =>$childNodes));
    }
    $children = array_values(array_sort($children, function($value) { return $value['text'];}));
    array_unshift($data, array('id' => '#', 'text' => 'root' , 'state' => $nodeState, 'children' => $children));
    return json_encode($data);
}
