<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerCheckOut extends Model
{
    protected $fillable = [
        'food_name','price','quantity', 'name', 'email', 'mobile','address','postcode','comments','order','uid'
    ];
}
