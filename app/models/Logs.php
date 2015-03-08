<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Logs extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Logs';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();

    protected $fillable = array('LogDate', 'LogType', 'LogKey1', 'LogKey2', 'LogUserID', 'LogMessage', 'updated_at', 'created_at');

    public function type()
    {
        return $this->hasOne('LogType', 'ID', 'LogType');
    }

    public function user()
    {
        return $this->hasOne('User', 'id', 'LogUserID'); // odd names because of laravel standards.
    }

    // --------------------------------------------------------------
    // Create a new log message, auto fill in date stamp and user id.
    public static function LogMsg($LogType, $KitTypeID, $KitID, $ContentsID, $Message)
    {
        // print $LogType. ", " .$KitTypeID. ", " .$KitID. ", " .$ContentsID. ", " .$Message . " --- ";
        $log = new Logs();
        $log->LogDate = new DateTime('today');
        // print $log->LogDate;
        $log->LogType = $LogType;
        $log->LogKey1 = $KitTypeID;
        $log->LogKey2 = $KitID;
        //$log->LogKey3 = $ContentsID;
        $log->LogUserID = Auth::user()->id;
        $log->LogMessage = $Message;
        $log->save();

    }
    // --------------------------------------------------------------
    // Make a log entry for LogType '1','Damage Report'
    public static function DamageReport($KitID, $ContentsID, $Message)
    {
        // Logs::LogMsg(1, $KitID, $ContentsID, $Message);
    }
    // --------------------------------------------------------------
    // Make a log entry for LogType '2','Missing Report'
    public static function MissingReport($KitID, $ContentsID, $Message)
    {
        // Logs::LogMsg(2, $KitID, $ContentsID, $Message);
    }
    // --------------------------------------------------------------
    // Make a log entry for LogType '3','Note'
    public static function Note($KitID, $ContentsID, $Message)
    {
        // Logs::LogMsg(3, $KitID, $ContentsID, $Message);
    }
    // --------------------------------------------------------------
    // Make a log entry for LogType '7','Kit Type Created'
    public static function KitTypeCreated($KitTypeID)
    {
        // Logs::LogMsg(7, $KitTypeID, NULL, "Kit Type created");
    }
    // --------------------------------------------------------------
    // Make a log entry for LogType '8','Kit Type Edited'
    public static function KitTypeEdit($KitTypeID, $field, $from, $to)
    {
        // Logs::LogMsg(8, $KitTypeID, NULL, "Changed ". $field . " From: '" . $from . "'' To: '" . $to ."'");
    }
    // --------------------------------------------------------------
    // Make a log entry for LogType '9','Kit Type Deleted'
    public static function KitTypeDelete($KitTypeID)
    {
        // Logs::LogMsg(9, $KitTypeID, NULL, "Kit Type created");
    }

    // --------------------------------------------------------------
    // Make a log entry for LogType '16','Kit Transfer Shipped'
    public static function KitTransferedShipped($BookingID, $KitID, $At)
    {
        // Logs::LogMsg(16, $BookingID, $KitID, "Kit Shipped from " . $At);
    }
    // --------------------------------------------------------------
    // Make a log entry for LogType '17','Kit Transfer Received'
    public static function KitTransferedReceived($BookingID, $KitID, $At)
    {
        // Logs::LogMsg(17, $BookingID, $KitID, "Kit Received at" . $At);
    }

}
