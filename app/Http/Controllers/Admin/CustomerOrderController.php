<?php

namespace App\Http\Controllers\Admin;

use App\CustomerOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CustomerOrderController extends Controller
{
    /**
     * @param Request $request
     */
    public function orderDone(Request $request)
    {
        //$input = $request->all();
        if (Session::has('cart')) {
            $cartitems = Session::get('cart');
            //dd($cartitems->items['1']['qty']);
            $totalPrice= $cartitems->totalPrice;
            foreach($cartitems->items as $item) {
//                dd($item['item']['name']);
                CustomerOrder::create([
                    'food_name'=> $item['item']['name'],
                    'price' =>$item['price'] ,
                    'quantity' => $item['qty'],
                    'name'        =>  $request->name,
                    'email'        =>  $request->email,
                    'mobile'        =>  $request->mobile,
                    'address'        =>  $request->address,
                    'postcode'        =>  $request->postcode,
                    'comments'        =>  $request->comments,
                    //'total'=> 12321,
                    
                ]);
            }
        }
       return view('user.checkout.orderdone');
    }
    
    public function OrderComplete($id)
    {
        $data = CustomerOrder::findOrFail($id);
        $data->delete();
        
        return redirect('admin/order');
    }
}
