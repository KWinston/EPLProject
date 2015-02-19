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
        return $this->hasOne('LogType', 'LogType', 'ID');
    }

    public function user()
    {
        return $this->hasOne('users', 'LogUserID', 'id'); // odd names because of laravel standards.
    }
}
