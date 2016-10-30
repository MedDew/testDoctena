<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['category_name'];
    
    /**
     * Prevent eloquent from handling the users table's column updated_at & created_at
     * 
     * @var boolean
     */
    public $timestamps = false;
    
    public function books()
    {
        return $this->belongsToMany("App\Book", "books_categories");
    }
    
    public function hasManyBook() 
    {
        return $this->hasMany("App\Book");
    }
}
