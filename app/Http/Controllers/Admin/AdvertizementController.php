<?php

namespace App\Http\Controllers\Admin;

use App\Advertizement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdvertizementController extends Controller
{
    
    public function create()
    {
        
        return view('admin.advertise.create');
    }
    
    public function store(Request $request)
    {
       
        $image_name = $request->name;
        $image = $request->file('file');
        if($image != '')
        {
            $request->validate([
                'name'    =>  'required',
                'file'         =>  'image|max:2048'
            ]);
        
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move('storage/ad', $image_name);
        
        }
        else
        {
            $request->validate([
                'name'    =>  'required',
            ]);
        }
        //dd($input);
        $form_data = array(
            'name'=>$request->name,
            'file' =>$image_name,
    
        );
        
        //dd($form_data);
       Advertizement::create($form_data);
    
        //dd($m);
        return redirect('admin/advertise/');
    }
    
    
    public function index()
    {
        $items = Advertizement::all();
        return view('admin.advertise.index',compact('items'));
    }
    
    public function deleteAdvertise($id)
    {
        $data = Advertizement::findOrFail($id);
        $data->delete();
        
        return redirect('admin/advertise');
        
    }
}
