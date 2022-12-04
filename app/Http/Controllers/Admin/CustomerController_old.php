<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function showCustomer()
    {
        $customers =Customer::all();
    
        return view('admin.customer.index',compact('customers'));
        
    }
    
    public function store(Request $request)
    {
        $customer = new Customer;
        
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->mobile = $request->input('mobile');
        $customer->address = $request->input('address');
        $customer->postcode = $request->input('postcode');
        $customer->comments = $request->input('comments');
        
        $customer->save();
    
    }
}
