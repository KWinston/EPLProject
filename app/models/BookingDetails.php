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

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();

    protected $fillable = array('BookingID', 'UserID', 'Email', 'Booker', 'updated_at', 'created_at');


    public function booking()
    {
        return $this->hasOne('Booking', 'ID', 'BookingID');
    }
}
