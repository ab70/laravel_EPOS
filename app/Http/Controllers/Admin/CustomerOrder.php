<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerOrder extends Controller
{
    public function orderDone(Request $request)
    {
        $input = $request->all();
        dd($input);
        //Customer::create();
    }
}
