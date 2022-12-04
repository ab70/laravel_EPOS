<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public $table = 'food';
    protected $fillable = [
        'name', 'menu_id','additive_id', 'description','price','file',
    ];
    
    public function menu()
    {
        
        return $this->belongsTo('App\Menu','menu_id');
        
    }
    public function additive()
    {
        
        return $this->belongsTo('App\Additive','additive_id');
        
    }
}
