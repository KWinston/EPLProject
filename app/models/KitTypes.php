<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class KitTypes extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'KitTypes';
    protected $primaryKey = 'ID';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();

    protected $fillable = array('Name', 'TypeDescription');

    public static function boot()
    {
        parent::boot();

        static::created(function($record)
        {
            Logs::LogMsg(7,
                $record->ID,
                null, null,
                "Type Created"
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
                    Logs::LogMsg(19,
                        $record->ID,
                        null, null,
                        $field . " changed From:" . $olddata . " To:" . $newdata
                    );
                }
            }
            return true;
        });

        static::deleting(function($record)
        {
            Logs::LogMsg(20,
                $record->ID,
                null, null,
                "Kit type deleted by:" . Auth::user()->username);
            return true;
        });

    }
    public function kits()
    {
        return $this->hasMany('Kits', 'KitType', "ID");
    }

}
