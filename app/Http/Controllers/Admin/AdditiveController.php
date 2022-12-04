<?php

namespace App\Http\Controllers\Admin;

use App\Additive;
use App\Food;
use App\FoodItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdditiveController extends Controller
{
    public function create()
    {
        return view('admin.additive.create');

    }


    public function index()
    {
        $adds = Additive::all();
        return view('admin.additive.index',compact('adds'));
    }

    public function storeAdditive(Request $request)
    {
        $image_name = $request->name;
        $image = $request->file('file');
        if($image != '')
        {
            $request->validate([
                'name'    =>  'required',
                'file'    =>  'image|max:2048'
            ]);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move('storage/additive_image', $image_name);
        }
        else
        {
            $request->validate([
                'name'    =>  'required',
            ]);
        }

        $form_data = array(
            'name'       =>   $request->name,
            'file'       =>   $image_name
        );

        Additive::create($form_data);

        return redirect('/additive/list');
    }


//       Additive::create($input);
//        //dd($m);
//        return redirect('admin/additive/list');
//
//
//    }

    public function editAdditive($id)
    {
        $adds = Additive::findOrFail($id);
        return view('admin.additive.edit',compact('adds'));

    }
    public function updateAdditive(Request $request,$id)
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
            $image->move('storage/additive_image', $image_name);
        }
        else
        {
            $request->validate([
                'name'    =>  'required',
            ]);
        }

        $form_data = array(
            'name'       =>  $request->name,
            'file'       =>  $image_name
        );

        Additive::whereId($id)->update($form_data);

        return redirect('/additive/list');
    }

    public function deleteAdditive($id)
    {
        $data = Additive::findOrFail($id);
        $data->delete();

        return redirect('/additive/list');
    }

}
