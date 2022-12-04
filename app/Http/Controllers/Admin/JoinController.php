<?php

namespace App\Http\Controllers\Admin;

use App\Join;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class JoinController extends Controller
{
    public function joinTable()
    {
        $data = DB::table('joins')
            ->join('food_items','food_items.id','=','fooditem_id')
            ->join('additives','additives.id','=','additive_id')
            ->select('additives.file','food_items.name')
            ->get();
            
        
            //dd($data);
            
//            foreach ($data as $x){
//
//                dd($x->file);
//            }
    }
    
    public function joinTableStore(Request $request)
    {
        $input=$request->all();
        //dd($input);
    
        Join::create($input);
        return redirect('admin/food-item');
    
    }
    
    public function joinTableEdit($id)
    {
        return view('admin.food_item.edit',['item'=>Join::findOrFail($id)]);
    }
    public function joinTableUpdate(Request $request)
    
    {
        $join = new Join();
        $input = $request->all();
        dd($input);
       // $join->Update($input);
    
        return redirect('admin/food-item');
        
    }
}
