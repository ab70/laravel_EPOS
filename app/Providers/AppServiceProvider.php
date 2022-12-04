<?php

namespace App\Providers;

use App\Cart;
use App\FoodItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        View::composer('user.newFood.index', function ($view) {
//            $foods = FoodItem::all();
//            $data = DB::table('joins')
//                ->join('food_items','food_items.id','=','joins.fooditem_id')
//                ->join('additives','additives.id','=','joins.additive_id')
//                ->select('additives.file','joins.fooditem_id')
//                ->get();
//
//
//
//            $view->with('foods','data',$foods,$data);
//        });
    
    }
}
