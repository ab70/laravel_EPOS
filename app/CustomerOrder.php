<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    protected $fillable = [
       'food_name','price','quantity', 'name', 'email', 'mobile','address','postcode','comments'
    ];
}
