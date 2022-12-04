<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
    protected $fillable = [
        'additive_id','fooditem_id'
    ];
}
