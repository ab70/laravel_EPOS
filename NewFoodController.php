<?php

namespace App\Http\Controllers\User;

use App\Additive;
use App\Food;
use App\FoodItem;
use App\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;

class NewFoodController extends Controller
{
//    public function showCategory()
//    {
//        //$menus = Menu::all() ;
//        //dd($menus);
//        $foods='';
//
//        return view('user.newFood.index',compact('foods'));
//    }

    public function showFood($id)
{
    // selecting all food item
    
    $foods = Food::where('menu_id', '=', $id)->get();

//        $data = DB::table('joins')
//            ->join('food_items','food_items.id','=','joins.fooditem_id')
//            ->join('additives','additives.id','=','joins.additive_id')
//            ->select('additives.file','joins.fooditem_id')
//            ->get();
    
    $data = Additive::all();
    // return view('user.newFood.index',compact('foods','data'));
    
    return view('user.newFood.index',compact('foods','data'));
}
    
    
    public function showEpoz($id)
    {
        // selecting all food item
        
        $foods = Food::where('menu_id', '=', $id)->get();
        //dd($foods);
        return view('epoz.index',compact('foods'));
    }
    
    
    
}
