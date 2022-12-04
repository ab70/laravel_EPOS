<?php

namespace App\Http\Controllers\Admin;

use App\CustomerOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    
    public function getOrder()
    {
        
    }
    
    public function showOrder()
    {
        $orders =CustomerOrder::all();
        
        return view('admin.order.index',compact('orders'));
        
    }
}
