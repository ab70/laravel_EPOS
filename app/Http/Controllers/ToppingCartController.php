<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Topping;
use Illuminate\Http\Request;

class ToppingCartController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        
        //$toppings = DB::table('toppings')->where('menu_id', $id)->get();
    
        return view('user.topping-cart.product', compact('menus'));
        
    }
    
    public function cart()
    {
        
        return view('user.topping-cart.cart');
    }
    
    
    
    
    
    public function addToCart($id)
    {
        $topping = Topping::find($id);
        
        if(!$topping) {
            
            abort(404);
            
        }
        
        $cart = session()->get('cart');
        
        // if cart is empty then this the first product
        if(!$cart) {
            
            $cart = [
                $id => [
                    "name" => $topping->name,
                    "quantity" =>1,
                    "price" => $topping->price,
                ]
            ];
           // dd($cart);
            session()->put('cart', $cart);
            
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
            
            $cart[$id]['quantity']++;
            
            session()->put('cart', $cart);
            
            return redirect()->back()->with('success', 'Product added to cart successfully!');
            
        }
        
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $topping->name,
            "quantity" => 1,
            "price" => $topping->price,
        ];
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    
    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
            
            $cart[$request->id]["quantity"] = $request->quantity;
            
            session()->put('cart', $cart);
            
            session()->flash('success', 'Cart updated successfully');
        }
    }
    
    public function remove(Request $request)
    {
        if($request->id) {
            
            $cart = session()->get('cart');
            
            if(isset($cart[$request->id])) {
                
                unset($cart[$request->id]);
                
                session()->put('cart', $cart);
            }
            
            session()->flash('success', 'Product removed successfully');
        }
    }
}
