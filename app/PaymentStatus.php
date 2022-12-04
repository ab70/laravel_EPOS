<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    protected $fillable = [
        'order_id','amount','method','table_no','person','ordered_food','quantity','price','openfood','dis_percent','dis_cash','paid','change_cash',
    ];
    public function setOrderedfoodAttribute($value)
    {
        $this->attributes['ordered_food'] = json_encode($value);
    }

    public function getOrderedfoodAttribute($value)
    {
        $this->attributes['ordered_food'] = json_decode($value);
    }
    public function setpriceAttribute($value)
    {
        $this->attributes['price'] = json_encode($value);
    }

    public function getpriceAttribute($value)
    {
        $this->attributes['price'] = json_decode($value);
    }
    public function setqtyAttribute($value)
    {
        $this->attributes['quantity'] = json_encode($value);
    }

    public function getqtyAttribute($value)
    {
        $this->attributes['quantity'] = json_decode($value);
    }
}
