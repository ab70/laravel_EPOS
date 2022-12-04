<?php

namespace App\Http\Controllers\Admin;

use App\Additive;
use App\Food;
use App\FoodItem;
use App\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FoodItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Food::all();
//        $data = DB::table('joins')
//            ->join('food_items','food_items.id','=','joins.fooditem_id')
//            ->join('additives','additives.id','=','joins.additive_id')
//            ->select('additives.file','joins.fooditem_id')
//            ->get();
        $data = Additive::all();
//        dd($items);
        return view('admin.food_item.index',compact('items','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all() ;
        $adds = Additive::all();
        $items = Food::all();

        return view('admin.food_item.create',compact('menus','adds','items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            $image->move('storage/food_image', $image_name);

        }
        else
        {
            $request->validate([
                'name'    =>  'required',
            ]);
        }

        $form_data = array(
            'name'        =>  $request->name,
            'price'       =>  $request->price,
            'description' =>  $request->description,
            'menu_id'       =>   $request->menu_id,
            'additive_id'       =>   $request->additive_id,
            'file' =>$image_name,

        );

        Food::create($form_data);

        return redirect('/food-item/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('admin.food_item.edit',['item'=>Food::findOrFail($id),'menus'=>Menu::all(),'adds'=>Additive::all(),'menu_name' => DB::table('menus')->where('id', $id)->value('name'),
            ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
            $image->move('storage/food_image', $image_name);

        }
        else
        {
            $request->validate([
                'name'    =>  'required',
            ]);
        }

        $form_data = array(
            'name'        =>  $request->name,
            'price'       =>  $request->price,
            'description' =>  $request->description,
            'menu_id'      =>   $request->menu_id,
            'additive_id'  =>   $request->additive_id,
            'file' =>$image_name,

        );

        Food::whereId($id)->update($form_data);

        return redirect('/food-item/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Food::findOrFail($id);
        $data->delete();
        return redirect('/food-item/');
    }
}
