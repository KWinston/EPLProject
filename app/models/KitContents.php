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

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();

    protected $fillable = array('KitID', 'Name', 'SerialNumber', 'Damaged', 'Missing', 'updated_at', 'created_at');

    public function kit()
    {
        return $this->hasOne('Kits', 'ID', 'KitID');
    }
}
