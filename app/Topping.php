<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    protected $fillable = [
        'name', 'menu_id','price',
    ];
    public function menu()
    {
        
        return $this->belongsTo('App\Menu','menu_id');
        
    }
}
