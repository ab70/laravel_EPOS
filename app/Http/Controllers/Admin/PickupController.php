<?php

namespace App\Http\Controllers\Admin;

use App\Pickup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PickupController extends Controller
{
    public function index()
    {
       $all_pickup = Pickup::all();
       return view('admin.pickup.index',compact('all_pickup'));
    }
    public function createPickup(Request $request)
    {
         
         return view('admin.pickup.create');
    }
    
    public function storePickup(Request $request)
    {
        $input = $request->all();
        Pickup::create($input);
        
        return redirect('admin/pickup/list');
        
        
    }
    
    public function editPickup($id)
    {
        $pickup = Pickup::findOrFail($id);
        
        return view('admin.pickup.edit',compact('pickup'));
    }
    
    public function updatePickup(Request $request,$id)
    {
        $pickup = Pickup::findOrFail($id) ;
       // dd($pickup);
        $pickup->Update($request->all());
    
        return redirect('admin/pickup/list');
    }
    
    public function deletePickup($id)
    {
        $data = Pickup::findOrFail($id);
        $data->delete();
    
        return redirect('admin/pickup/list');
        
    }
}
