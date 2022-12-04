<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use App\Topping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ToppingController extends Controller
{
    
    public function index()
    {
        $toppings=Topping::all();
        
        return view('admin.topping.index',compact('toppings'));
    }
    
    
    public function create()
    {
        $menus = Menu::all() ;
        
        return view('admin.topping.create',compact('menus'));
    }
    
    public function store(Request $request)
    {
        $input=$request->all();
        
        //dd($input);
        
        Topping::create($input);
        //dd($m);
        return redirect('admin/topping-list');
    }
    public function edit($id)
    {
        $menus = Menu::all() ;
        return view('admin.topping.edit',['topping'=>Topping::findOrFail($id)],compact('menus'));
        
    }
    
    
}
