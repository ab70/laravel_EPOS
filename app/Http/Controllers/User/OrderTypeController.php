<?php

namespace App\Http\Controllers\User;

use App\Delivery;
use App\OrderType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class OrderTypeController extends Controller
{
    public function createOrderType()
    {
        return view('admin.order_type.create');
    }
    
    public function storeOrderType(Request $request)
    {
        $input = $request->all();
//        dd($input);
        
        OrderType::create($input);
    }
    
    public function delivery(Request $request)
    {
        $input = $request->all();
       //dd($input);
        Session::put('charge', $input);
    
        return redirect()->back();
    }
}
