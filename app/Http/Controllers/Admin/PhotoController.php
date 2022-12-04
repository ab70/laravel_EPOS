<?php

namespace App\Http\Controllers\Admin;

use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{
    
    public function create()
    {
        return view('admin.slider.create');
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
            $image->move('storage/gallery', $image_name);
        
        }
        else
        {
            $request->validate([
                'name'    =>  'required',
            ]);
        }
    
        $form_data = array(
            'name'        =>  $request->name,
            'file' =>$image_name,
    
        );
    
        //dd($input);
        
        Photo::create($form_data);
        //dd($m);
        return redirect('admin/photo/');
    }
    
    
    public function index()
    {
        $items = Photo::all();
       // dd($items);
        return view('admin.slider.index',compact('items'));
    }
    
    public function deletePhoto($id)
    {
        $data = Photo::findOrFail($id);
        $data->delete();
        
        return redirect('admin/photo/');
    }
}
