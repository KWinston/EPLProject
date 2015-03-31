<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class KitContents extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'KitContents';
    protected $primaryKey = 'ID';

    public static function boot()
    {
        parent::boot();

        static::created(function($record)
        {
            $kitTypeID = $record->kit->KitType;
            $kitID = $record->kit->ID;
            Logs::LogMsg(10, $kitTypeID, $kitID, $record->ID, "Added content: " . $record->Name);
            return true;
        });

        static::updating(function($record)
        {
            $kitTypeID = $record->kit->KitType;
            $kitID = $record->kit->ID;
            $dirty = $record->getDirty();
            foreach ($dirty as $field => $newdata)
            {
                $olddata = $record->getOriginal($field);
                if ($olddata != $newdata)
                {
                    Logs::LogMsg(11, $kitTypeID, $kitID, $record->ID, "Changed ". $field . " From:" . $olddata . " To:" . $newdata);
                }
            }
            return true;
        });

        static::deleting(function($record)
        {
            $kitTypeID = $record->kit->KitType;
            $kitID = $record->kit->ID;
            Logs::LogMsg(12, $kitTypeID, $kitID, $record->ID, "Removed Contents: " . $record->Name);
            return true;
        });
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();

    protected $fillable = array('KitID', 'Name', 'SerialNumber', 'DamagedLogID', 'MissingLogID', 'updated_at', 'created_at');

    public function kit()
    {
        return $this->hasOne('Kits', 'ID', 'KitID');
    }
    public function missingMessage()
    {
        return $this->hasOne('Logs', 'ID', 'MissingLogID');
    }
    public function damagedMessage()
    {
        return $this->hasOne('Logs', 'ID', 'DamagedLogID');
    }
    
}
