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

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();

    protected $fillable = array('KitID', 'ForBranch', 'StartDate', 'EndDate', 'ShadowStartDate', 'ShadowEndDate', 'Purpose', 'updated_at', 'created_at');

    public function branch()
    {
        return $this->hasOne('Branch', 'ID', 'ForBranch');
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
