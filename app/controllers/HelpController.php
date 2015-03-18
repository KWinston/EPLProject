<?php
include('Globals/GlobalFunctions.php');

class HelpController extends BaseController {

    function page($topic)
    {
         return View::make('help.' . $topic , array('selected_topic' => $topic));
    }
}
