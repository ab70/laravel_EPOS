<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\CustomerCheckOut;
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
        $orders =CustomerCheckOut::all();
        
        return view('admin.order.index',compact('orders'));
        
    }
    
    public function status($id)
    {
        $customer=Customer::find($id);
        $customer->status=1;
        $customer->save();
        return redirect('admin/order')->with('success','Order marked as Complete!');
    }
}
