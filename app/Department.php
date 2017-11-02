<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    /** Get all normal members of this department
    *
    * @return User Collection
    */
    public function getMembers()
    {
        return $this->belongsToMany('App\User')->withPivot('is_manager')->wherePivot('is_manager', false);
    }

    /** Get manager member of department
    *
    * @return User
    */
    public function getManager()
    {
        return $this->belongsToMany('App\User')->withPivot('is_manager')->wherePivot('is_manager', true);
    }

    /** Get all members of department
    *
    * @return User Collection
    */
    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('is_manager');
    }

     /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];
}
