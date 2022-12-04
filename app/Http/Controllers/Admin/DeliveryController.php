<?php

namespace App\Http\Controllers\Admin;

use App\Delivery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryController extends Controller
{
    public function createDelivery(Request $request)
    {
        $input = $request->all();
        //dd($input);
        Delivery::create($input);
    }
    
    public function addTotal($id)
    {
        $totalPrice =$id;
        
        return view('user.newFood.index',compact('totalPrice'));
    }
    
    
}
