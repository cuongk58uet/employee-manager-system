<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /** Determine department which this user is manager
    *
    * @return Department if exist
    */
    public function isManagerOfDepartment()
    {
        return $this->belongsToMany('App\Department')->withPivot('is_manager')->wherePivot('is_manager', true);
    }

    /** Determine department which this user is a member
    *
    * @return Department if exist
    */
    public function isMemberOfDepartment()
    {
        return $this->belongsToMany('App\Department')->withPivot('is_manager')->wherePivot('is_manager', false);
    }

    /** Determine all departments
    *
    * @return Department Collection
    */
    public function departments()
    {
        return $this->belongsToMany('App\Department')->withPivot('is_manager');
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
