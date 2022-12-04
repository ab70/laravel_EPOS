<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    protected $fillable = [
        'name', 'menu_id', 'description','price','file',
    ];
    
    public function menu()
    {
        
        return $this->belongsTo('App\Menu','menu_id');
        
    }
    public function additives()
    {
        
        return $this->hasMany('App\Additive');
        
    }
}
