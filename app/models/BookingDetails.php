<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class BookingDetails extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'BookingDetails';
    protected $primaryKey = 'ID';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();

    protected $fillable = array('BookingID', 'UserID', 'Email', 'Booker', 'updated_at', 'created_at');

    public static function boot()
    {
        parent::boot();

        static::created(function($record)
        {
            $userName = "";
            if (isset($record->UserID))
            {
                $userName = Users::find($record->UserID)->username;
            }
            else
            {
                $userName = $record->Email;
            }
            $primaryBooker = " as primary booker";
            if (! $record->Booker)
            {
                $primaryBooker = " as secondary contact";
            }
            Logs::LogMsg(18,
                $record->booking->kit->KitType,
                $record->booking->kit->ID,
                $record->booking->branch->ID,
                "Added user:" . $userName . $primaryBooker
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
                        $record->booking->kit->KitType,
                        $record->booking->kit->ID,
                        $record->booking->branch->ID,
                        $field . " changed From:" . $olddata . " To:" . $newdata
                    );
                }
            }
            return true;
        });

        static::deleting(function($record)
        {
            Logs::LogMsg(20,
                $record->booking->kit->KitType,
                $record->booking->kit->ID,
                $record->booking->branch->ID,
                "Detail deleted by:" . Auth::user()->username);
            return true;
        });

    }


    public function booking()
    {
        return $this->hasOne('Booking', 'ID', 'BookingID');
    }
}
