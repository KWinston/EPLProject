<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Booking extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Booking';
    protected $primaryKey = 'ID';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();

    protected $fillable = array('KitID', 'ForBranch', 'StartDate', 'EndDate', 'ShadowStartDate', 'ShadowEndDate', 'Purpose', 'updated_at', 'created_at');


    public static function boot()
    {
        parent::boot();

        static::created(function($record)
        {
            Logs::LogMsg(13,
                $record->kit->KitType,
                $record->kit->ID,
                $record->branch->ID,
                "Booking for:" . $record->branch->BranchID . " from:" . $record->StartDate . " To:". $record->EndDate
            );
            return true;
        });

        static::updating(function($record)
        {

            $dirty = $record->getDirty();
            foreach ($dirty as $field => $newdata)
            {
                $olddata = $record->getOriginal($field);
                if ($olddata != $newdata)
                {
                    Logs::LogMsg(15,
                        $record->kit->KitType,
                        $record->kit->ID,
                        $record->branch->ID,
                        "Changed booking ". $field . " From:" . $olddata . " To:" . $newdata
                    );
                }
            }
            return true;
        });

        static::deleting(function($record)
        {
            Logs::LogMsg(14,
                $record->kit->KitType,
                $record->kit->ID,
                $record->branch->ID,
                "Booking Deleted by:" . Auth::user()->username);
            return true;
        });

    }


    public function branch()
    {
        return $this->hasOne('Branches', 'ID', 'ForBranch');
    }

    public function kit()
    {
        return $this->hasOne('Kits', 'ID', 'KitID');
    }

    public function details()
    {
        return $this->hasMany('BookingDetails', 'BookingID', 'ID');
    }
}
