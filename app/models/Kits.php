<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Kits extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Kits';
    protected $primaryKey = 'ID';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();

    protected $fillable = array('KitType', 'Name', 'AtBranch', 'Available', 'KitState', 'BarcodeNumber', 'KitDesc', 'Specialized', 'SpecializedName');

    public static function boot()
    {
        parent::boot();

        static::created(function($record)
        {
            $kitTypeID = $record->KitType;
            $kitID = $record->ID;
            Logs::LogMsg(4, $kitTypeID, $kitID, null, "Created Kit: " . $record->Name);
            return true;
        });

        static::updating(function($record)
        {

            $kitTypeID = $record->KitType;
            $kitID = $record->ID;
            $dirty = $record->getDirty();
            foreach ($dirty as $field => $newdata)
            {
                $olddata = $record->getOriginal($field);
                if ($olddata != $newdata)
                {
                    Logs::LogMsg(5, $kitTypeID, $kitID, null, "Changed Kit field: ". $field . " From:" . $olddata . " To:" . $newdata);
                }
            }
            return true;
        });

        static::deleting(function($record)
        {
            $kitTypeID = $record->KitType;
            $kitID = $record->ID;
            Logs::LogMsg(6, $kitTypeID, $kitID, null, "Deleted Kit: " . $record->Name);
            return true;
        });

    }


    public function atBranch()
    {
        return $this->hasOne('Branches', 'ID', 'AtBranch');
    }

    public function type()
    {
        return $this->hasOne('KitTypes', 'ID', 'KitType');
    }

    public function state()
    {
        return $this->hasOne('KitState', 'ID', 'KitState');
    }

    public function contents()
    {
        return $this->hasMany('KitContents', 'KitID', 'ID');
    }

}
