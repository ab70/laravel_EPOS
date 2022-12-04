<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
    ];
    
    
    public function fooditems()
    {
        
        return $this->hasMany('App/FoodItem');
        
    }
    
    public function foods()
    {
        
        return $this->hasMany('App/Food');
        
    }
    
    public function toppings()
    {
        
        return $this->hasMany('App/FoodItem');
        
    }
}
