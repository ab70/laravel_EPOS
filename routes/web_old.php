<?php
    
    use Illuminate\Support\Facades\Route;
    use Illuminate\Http\Request;
    use Carbon\Carbon;
    
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */
    
    Route::view('/admin', 'auth.login')->name('login');

// admin
    Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function()
    {
    //home
    Route::get('/', function () {
        return view('admin.layouts.index');
    });

    //menu

    Route::resource('menu','Admin\MenuController');

    //food-item

    Route::resource('food-item','Admin\FoodItemController');

    //admin-customer

    Route::get('customer','Admin\CustomerController@showCustomer')->name('admin.customer');

    //admin-order

    Route::get('order','Admin\OrderController@showOrder')->name('admin.order');

    // additive
    
    Route::get('additive/list','Admin\AdditiveController@index')->name('additive.list');
    Route::get('additive/create','Admin\AdditiveController@create')->name('additive.create');
    Route::post('additive/store','Admin\AdditiveController@storeAdditive')->name('additive.store');
    Route::get('additive/edit/{id}','Admin\AdditiveController@editAdditive')->name('additive.edit');
    Route::put('additive/update/{id}','Admin\AdditiveController@updateAdditive')->name('additive.update');
    Route::get('additive/delete/{id}','Admin\AdditiveController@deleteAdditive')->name('additive.delete');
    
    
        //toppings
    
    Route::get('add-topping','Admin\ToppingController@create')->name('topping.create');
    
    Route::get('topping-list','Admin\ToppingController@index')->name('topping.index');
    
    Route::post('topping-list','Admin\ToppingController@store')->name('topping.store');
    
    Route::get('topping-edit/{id}','Admin\ToppingController@edit')->name('topping.edit');
    
    //photo
    Route::get('photo/create','Admin\PhotoController@create')->name('photo.create');
    Route::post('photo/','Admin\PhotoController@store')->name('photo.store');
    Route::get('photo/','Admin\PhotoController@index')->name('photo');
    Route::get('photo/delete/{id}','Admin\PhotoController@deletePhoto')->name('photo.delete');
    
        //join
    
    Route::get('join','Admin\JoinController@joinTable');
    Route::post('add-join','Admin\JoinController@joinTableStore')->name('join.store');
    Route::put('join-update','Admin\JoinController@joinTableUpdate')->name('join.update');
    
    
        // advertise
    Route::get('advertise/','Admin\AdvertizementController@index')->name('advertise');
    Route::view('advertise/create','admin.advertise.create')->name('advertise.create');
    Route::post('advertise/store/','Admin\AdvertizementController@store')->name('advertise.store');
    
    Route::get('advertise/delete/{id}','Admin\AdvertizementController@deleteAdvertise')->name('advertise.delete');
    
    
        //pickup
//        Route::get('admin/pickup/','admin.pickup.create')->name('pickup.create');
        Route::get('pickup/list','Admin\PickupController@index')->name('pickup');
        Route::get('pickup/create','Admin\PickupController@createPickup')->name('pickup.create');
        Route::post('pickup/store','Admin\PickupController@storePickup')->name('pickup.store');
        Route::get('pickup/edit/{id}','Admin\PickupController@editPickup')->name('pickup.edit');
        Route::get('pickup/delete/{id}','Admin\PickupController@deletePickup')->name('pickup.delete');

//    Route::get('admin/pickup/update/{id}','Admin\PickupController@updatePickup')->name('pickup.update');
        Route::put('pickup/update/{id}','Admin\PickupController@updatePickup')->name('pickup.update');
    
        
    
    
        //date-time
        Route::resource('admin/date-time','DaysController');
        //time
        Route::post('admin/time','Admin\TimeController@store')->name('time.store');
    
        Route::get('admin/time','Admin\TimeController@index');
    
        Route::get('admin/time/{id}','Admin\TimeController@edit')->name('time.edit');
    
        Route::put('admin/time/{id}','Admin\TimeController@update')->name('store.time');
    
        Route::get('admin/time/delete/{id}','Admin\TimeController@delete')->name('delete.time');
    
    
    
        //delivery
    
        Route::view('admin/delivery/create','admin.delivery.create');
        Route::view('admin/delivery/list','admin.delivery.index');
        Route::post('admin/delivery/','Admin\DeliveryController@createDelivery')->name('delivery.create');
        Route::post('admin/delivery/total/{id}','Admin\DeliveryController@addTotal')->name('delivery.addTotal');
    
    
        //order
        Route::get('admin/order/create','User\OrderTypeController@createOrderType')->name('orderType.create');
        Route::post('admin/order','User\OrderTypeController@storeOrderType')->name('orderType.store');
    
    
    
    });
    
    
    
    //------------------------------------------------------------------------ + --------------------------------------------------------------
   
    
    
    
    
    
    //user

    Route::get('/','User\MenuController@showMenu')->name('myhome');

    Route::get('item/{id}','User\MenuController@showItemMenu')->name('item');

    Route::get('cart/{id}','User\CartController@getAddToCart')->name('addToCart');

//booking
    
        Route::view('booking','user.booking')->name('booking');
        Route::post('booking','User\MenuController@BookingOrder')->name('booking.store');
        Route::view('booking/details','admin.booking.index')->name('booking.details');
        Route::get('booking/delete/{id}','User\MenuController@deleteBooking')->name('booking.delete');

//    // laravel- ajax get
//    Route::get('/getRequest', function () {
//        if(Request::ajax()){
//                return 'getRequest has loaded completely';
//        }
//    });
//
//
//    Route::post('/register', function() {
//        if(Request::ajax()){
//            return Response::json(Request::all());
//    }
//    });

    //ajax-laravel part-2
    
    Route::view('customer','admin.customer.create');
    
    Route::post('customer-add','Admin\CustomerController@store');
    
    //topping cart
    
    
    Route::get('/topping', 'ToppingCartController@index');
    
    Route::get('topping-cart', 'ToppingCartController@cart')->name('topping-cart');
    
    Route::get('add-to-cart/{id}', 'ToppingCartController@addToCart')->name('add-to-cart');
    
    Route::patch('update-cart', 'ToppingCartController@update');
    
    Route::delete('remove-from-cart', 'ToppingCartController@remove');
    
    //new-food


    Route::view('newfood','user.newFood.ordernow')->name('menu');
        // Route::get('newfood','User\NewFoodController@showAdd')->name('food');

    Route::get('food/{id}','User\NewFoodController@showFood')->name('food');
//    Route::get('add-cart','User\NewFoodController@addCart')->name('food-cart.add');
    
    Route::post('add-cart','User\NewFoodController@addCart')->name('food-cart.add');
    
    
     //slider
    
    
    Route::view('slider','user.slider')->name('gallery');
    
   
    //Date
    
   

    //cart
    Route::get('cart/{id}','User\CartController@getAddToCart')->name('addToCart');
    Route::get('reduce/{id}','User\CartController@getReduceByOne')->name('reduceCart');
    Route::get('add/{id}','User\CartController@getAddToCart')->name('addCart');
    
    //order
    Route::post('order-send','Admin\CustomerOrderController@orderDone')->name('order-done');
    Route::get('order/complete/{id}','Admin\CustomerOrderController@OrderComplete')->name('order.complete');
    
    //paypal

    Route::get('/execute-payment','PaymentController@execute');
    Route::post('/create-payment','PaymentController@create')->name('create-payment');
    
    
    Route::post('delivery_charge','User\OrderTypeController@delivery')->name('delivery');

    
    //checkout
    
    Route::view('checkout','user.checkout.index')->name('checkout');
   
    
  
    
    //About
    Route::get('about',function(){
        
        return view('user.about');
    })->name('about');
    
    //contact
    Route::get('contact',function(){
        return view('user.contact');
    })->name('contact');
    



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
