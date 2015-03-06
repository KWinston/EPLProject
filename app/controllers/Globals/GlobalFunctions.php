<?php
function API_URL()
{
    return 'http://www.epl.ca/opendata/branches/api/:FORMAT/:BRANCH';
}

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
                $n = $n . ' + ' . $kit->SpecializedName;
            }
            array_unshift($childNodes, array('type' => 'KIT', 'id' => 'kit_' . $kit->ID, 'KitID' => $kit->ID, 'KitTypeID' => $kitType->ID ,'text' => $n , 'parent' => $key, 'state' => $nodeState, 'children' =>array()));
        }
        if (count($childNodes) > 0)
        {
            $childNodes = array_values(array_sort($childNodes, function($value) { return $value['text'];}));
            array_unshift($children, array('type' => 'TYPE','KitTypeID' => $kitType->ID, 'KitID' => NULL, 'id' => $key, 'text' => $kitType->Name , 'state' => $nodeState, 'children' =>$childNodes));
        }
    }
    $children = array_values(array_sort($children, function($value) { return $value['text'];}));
    array_unshift($data, array('type' => '#', 'id' => '#', 'text' => 'root' , 'state' => $nodeState, 'children' => $children));
    return json_encode($data);
}

function xmlToJSON ($url) {
    $fileContents= file_get_contents($url);
    $fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
    $fileContents = trim(str_replace('"', "'", $fileContents));
    $simpleXml = simplexml_load_string($fileContents);
    $json = json_encode($simpleXml);

    return $json;
}
