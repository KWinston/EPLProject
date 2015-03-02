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

    protected $fillable = array('KitType', 'Name', 'AtBranch', 'Available', 'KitState', 'KitDesc', 'Specialized', 'SecializedName', 'updated_at', 'created_at');

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
