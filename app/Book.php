<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = ['title', 'released_year'];
    
    /**
     * Prevent eloquent from handling the users table's column updated_at & created_at
     * 
     * @var boolean
     */
    public $timestamps = false;
    
    public function user() 
    {
        return $this->belongsTo("App\User");
    }
    
    public function categories() 
    {
        return $this->belongsToMany("App\Category", "books_categories");
    }
    
    public function hasManyCategory() 
    {
        return $this->hasMany("App\Category");
    }
}
