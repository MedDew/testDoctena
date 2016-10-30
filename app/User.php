<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'pseudo','password', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
    
    /**
     * Prevent eloquent from handling the users table's column updated_at & created_at
     * 
     * @var boolean
     */
    public $timestamps = false;
    
    
    public function books() 
    {
        return $this->hasMany("App\Book");
    }
    
    public function getRememberToken() 
    {
        return '';
    }
    
    public function setRememberToken($value)   
    {
    }
    
//    public function getRememberTokenName($param)
//    {
//        return 'no_remember_me_functionnality';
//    }
}
