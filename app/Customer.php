<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected  $table = 'customers';
    protected $fillable = [
        'name', 'email', 'mobile','address','postcode','comments','uid','order','status'
    ];
}
