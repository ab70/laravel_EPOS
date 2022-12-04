<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Additive extends Model
{
    protected $fillable = [
        'name','file',
    ];
    
    
    public function fooditem()
    {
        
        return $this->belongsTo('App/FoodItem','fooditem_id');
        
    }
    public function foods()
    {
        
        return $this->hasMany('App/Food');
        
    }
}
