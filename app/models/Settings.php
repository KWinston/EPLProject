<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Settings extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Settings';
    protected $primaryKey = 'ID';


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();

    protected $fillable = array('Key', 'Value');

    public static function HomeLink()
    {
        return Settings::where('Key', '=', 'HomeLink')->firstOrFail()->Value;
    }
    
    public static function ShadowDays()
    {
        return Settings::where('Key', '=', 'ShadowDays')->firstOrFail()->Value;
    }
}
