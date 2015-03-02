<?php
include('Globals/GlobalFunctions.php');

class LogsController extends BaseController
{

    // ---------------------------------------------------------------------------------------------------
    // Get the input parameters and make an array of LogType Id's clause from it. In the form of LogType in (...)
    private function ArrayOfFilters( $inputs )
    {
        $filter = array();
        foreach( $inputs as $key => $val )
        {
            // check to see it the input starts with 'FILTER-'
            if ( substr( $key, 0, 7 ) == "FILTER-" && $val == "T" )
            {
                array_unshift( $filter, substr( $key, 7 ) );
            }
        }
        return $filter;
    }

    // ---------------------------------------------------------------------------------------------------
    // Get the input parameters and make a filter clause from it. In the form of LogType in (...)
    private function GetFilterClause( $filters )
    {
        if (count($filters)> 0)
        {
            return  "LogType in (" . implode(', ', $filters) . ") and ";
        }
        return "";

    }

    // ---------------------------------------------------------------------------------------------------
    // Show the logs with a filter, for a single log key.
    public function show1($LogKey1)
    {
        $clause = "LogKey1 = " . $LogKey1;
        $filters = array();
        if (Input::get('FILTERS-ALL') != "T")
        {
            $filters = $this->ArrayOfFilters( Input::all() );
            $clause = $this->GetFilterClause( $filters ) . "LogKey1 = " . $LogKey1 ;
        }
        else
        {
            foreach(LogType::all() as $logType)
            {
                array_unshift($filters, $logType->ID);
            }
        }
        // print dd($clause);
        $logs = Logs::whereraw($clause)->get();
        $kTyp = KitTypes::find($LogKey1);
        $title = "Log for all " . $kTyp->Name;
        return CheckIfAuthenticated('Logs.show',['ID' => null ,'logs' => $logs, 'logTitle' => $title, 'logTypes' => LogType::all(), 'filters' => $filters], 'home.index', [], true);
    }

    // ---------------------------------------------------------------------------------------------------
    // Show the logs with a filter, for a double log key.
    public function show2($LogKey1 = NULL, $LogKey2 = NULL)
    {
        $clause = "LogKey1 = " . $LogKey1;
        $filters = array();

        if (Input::get('FILTERS-ALL') != "T")
        {
            $filters = $this->ArrayOfFilters( Input::all() );
            $clause = $this->GetFilterClause( $filters ) . "LogKey1 = " . $LogKey1;
        }
        else
        {
            foreach(LogType::all() as $logType)
            {
                array_unshift($filters, $logType->ID);
            }
        }

        if ($LogKey2)
        {
            $clause = $clause . " and LogKey2 = " . $LogKey2;
        }
        $logs = Logs::whereraw($clause)->get();

        $kTyp = KitTypes::find($LogKey1);
        $kit = Kits::find($LogKey2);
        $title = "Log for " . $kTyp->Name . " -> " . $kit->Name;
        if (((int)$kit->Specialized) == 1)
        {
            $title = $title . ' + ' . $kit->SecializedName;
        }
        return CheckIfAuthenticated('Logs.show',['ID' => $LogKey2, 'logs' => $logs, 'logTitle' => $title, 'logTypes' => LogType::all(), 'filters' => $filters], 'home.index', [], true);
    }
}
