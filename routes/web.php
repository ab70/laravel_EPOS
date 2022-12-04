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

    Route::view('/', 'auth.login')->name('login');


// admin
    Route::group(['prefix' => '/',  'middleware' => 'auth'], function()
    {


    //home
    Route::get('/admin', function () {
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
    Route::get('/status/{id}', 'Admin\OrderController@status')->name('status');

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

        //booking

        Route::post('booking','User\MenuController@BookingOrder')->name('booking.store');
        Route::view('booking/details','admin.booking.index')->name('booking.details');
        Route::get('booking/delete/{id}','User\MenuController@deleteBooking')->name('booking.delete');


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


        //ordertype
        Route::get('admin/order/create','User\OrderTypeController@createOrderType')->name('orderType.create');
        Route::post('admin/order','User\OrderTypeController@storeOrderType')->name('orderType.store');


    //blog

        Route::get('blogs/create','BlogController@create')->name('blog.create');
        Route::post('blog/store','BlogController@store')->name('blog.store');
        Route::get('blogs/list','BlogController@index')->name('blog.list');
        Route::get('blog/edit/{id}','BlogController@edit')->name('blog.edit');
        Route::put('blog/update/{id}','BlogController@update')->name('blog.update');


        //epoz start
        Route::get('epoz','epozCartController@index')->name('epozHome');
        Route::get('epos','epozCartController@index1')->name('epozHome2');
        Route::get('epoz/{id}','User\NewFoodController@showEpoz')->name('epoz');
        Route::get('pozcart/{id}','epozCartController@getepozcart')->name('epozCart');

        Route::get('epozreduce/{id}','epozCartController@getReduceByOne')->name('reduceEpoz');

        Route::get('clear','epozCartController@destroy')->name('destroyall');

        Route::post('tbl','epozCartController@tblno')->name('tblno');


        Route::get('',function (){

            $change = Session::get('change');
            return view('epoz.printPos',['change'=>$change]);
        });

        Route::get('cash','epozCartController@cash')->name('cash');

        Route::get('card','epozCartController@card')->name('card');

        Route::get('payments','epozCartController@payments')->name('payments');

        Route::get('show_edit',function (){
            return view('epoz.edit_discount');
        })->name('showedit');

        Route::get('edit_discount/{id}','epozCartController@editDiscount')->name('editdiscount');

        Route::put('updatediscount/{id}','epozCartController@updateDiscount')->name('updatediscount');

        Route::post('cashdiscount','epozCartController@extraCash')->name('extraCash');
        Route::post('open','epozCartController@open')->name('open');

        Route::get('show_tax',function (){
            return view('epoz.tax');
        })->name('tax');

        Route::get('edit/tax/{id}','epozCartController@editTax')->name('editTax');

        Route::put('update_tax/{id}','epozCartController@updateTax')->name('updateTax');

        Route::post('change','epozCartController@paidStore')->name('paid');

        Route::get('payments/refund/{id}','epozCartController@redfundPayments')->name('refund');

        Route::get('reducefood/{id}','epozCartController@reduceFood')->name('reduce');

        Route::post('months','epozCartController@monthly')->name('months');

        Route::post('tbl_order','epozCartController@orderTbl')->name('order_tbl');


        //tbl01
    Route::get('print',function (){
        return view('epoz.printPos');
    })->name('printPos1');
        Route::get('tblindex1','TblController1@index')->name('index1');
        Route::get('tpoz1/{id}','TblController1@showEpoz1')->name('epoz1');
        Route::get('morecart/{id}','TblController1@getepozcart')->name('moreCart');
        Route::post('cashdiscount1','TblController1@extraCash')->name('extraCash1');
        Route::post('open1','TblController1@open')->name('open1');

        Route::get('addservice1','TblController1@addServiceCharge')->name('addService1');

        // Route::put('updatediscount1/{id}','TblController1@updateDiscount')->name('updatediscount1');

       Route::post('tbl1','TblController1@tblCart01')->name('tbl1');
        Route::get('data','TblController1@gettbl')->name('gtbl');
        Route::get('less/{id}','TblController1@getReduceByOne')->name('less');
        Route::get('morecart/{id}','TblController1@getepozcart')->name('moreCart');
        Route::get('lessfood/{id}','TblController1@reduceFood')->name('lessfood');
        Route::post('change1','TblController1@paidStore')->name('tblpaid1');
        Route::get('tblcard','TblController1@card')->name('tblcard1');
        Route::get('printcardcash1','TblController1@printCashCard')->name('printcard1');

        Route::get('tbl1clear','TblController1@destroy')->name('destroy1');

        Route::post('tbl_order1','TblController1@orderTbl')->name('order_tbl1');
        //tbl02

        Route::get('addservice2','TblController2@addServiceCharge')->name('addService2');


        Route::get('print',function (){
            return view('epoz.printPos');
        })->name('printPos2');
        Route::post('tbl2','TblController2@tblCart01')->name('tbl2');
        Route::get('tblindex2','TblController2@index')->name('index2');
        Route::get('tpoz2/{id}','TblController2@showEpoz')->name('epoz2');

        Route::get('less2/{id}','TblController2@getReduceByOne')->name('less2');
        Route::get('morecart2/{id}','TblController2@getepozcart')->name('moreCart2');
        Route::get('lessfood2/{id}','TblController2@reduceFood')->name('lessfood2');
        Route::post('cashchange2','TblController2@paidStore')->name('tblpaid2');
        Route::get('tblcard2','TblController2@card')->name('tblcard2');
        Route::get('tbl1clear2','TblController2@destroy')->name('destroy2');

        Route::post('discount2','TblController2@extraCash')->name('extraCash2');
        Route::post('open2','TblController2@open')->name('open2');

        Route::post('tbl_order2','TblController2@orderTbl')->name('order_tbl2');


        //tbl03


        Route::get('addservice3','TblController3@addServiceCharge')->name('addService3');
        Route::get('print',function (){
            return view('epoz.printPos');
        })->name('printPos2');
        Route::post('tbl3','TblController3@tblCart01')->name('tbl3');
        Route::get('tblindex3','TblController3@index')->name('index3');
        Route::get('tpoz3/{id}','TblController3@showEpoz')->name('epoz3');

        Route::get('less3/{id}','TblController3@getReduceByOne')->name('less3');
        Route::get('morecart3/{id}','TblController3@getepozcart')->name('moreCart3');
        Route::get('lessfood3/{id}','TblController3@reduceFood')->name('lessfood3');
        Route::post('cashchange3','TblController3@paidStore')->name('tblpaid3');
        Route::get('tblcard3','TblController3@card')->name('tblcard3');
        Route::get('tbl1clear3','TblController3@destroy')->name('destroy3');

        Route::post('discount3','TblController3@extraCash')->name('extraCash3');
        Route::post('open3','TblController3@open')->name('open3');
        Route::post('tbl_order3','TblController3@orderTbl')->name('order_tbl3');

        //tbl04

        Route::get('addservice4','TblController4@addServiceCharge')->name('addService4');
        Route::get('print',function (){
            return view('epoz.printPos');
        })->name('printPos2');
        Route::post('tbl4','TblController4@tblCart01')->name('tbl4');
        Route::get('tblindex4','TblController4@index')->name('index4');
        Route::get('tpoz4/{id}','TblController4@showEpoz')->name('epoz4');

        Route::get('less4/{id}','TblController4@getReduceByOne')->name('less4');
        Route::get('morecart4/{id}','TblController4@getepozcart')->name('moreCart4');
        Route::get('lessfood4/{id}','TblController4@reduceFood')->name('lessfood4');
        Route::post('cashchange4','TblController4@paidStore')->name('tblpaid4');
        Route::get('tblcard4','TblController4@card')->name('tblcard4');
        Route::get('tbl1clear4','TblController4@destroy')->name('destroy4');
        Route::post('discount4','TblController4@extraCash')->name('extraCash4');
        Route::post('open4','TblController4@open')->name('open4');
        Route::post('tbl_order4','TblController4@orderTbl')->name('order_tbl4');




        //tbl05

        Route::get('addservice5','TblController5@addServiceCharge')->name('addService5');

         Route::get('print',function (){
            return view('epoz.printPos');
        })->name('printPos2');
        Route::post('tbl5','TblController5@tblCart01')->name('tbl5');
        Route::get('tblindex5','TblController5@index')->name('index5');
        Route::get('tpoz5/{id}','TblController5@showEpoz')->name('epoz5');

        Route::get('less5/{id}','TblController5@getReduceByOne')->name('less5');
        Route::get('morecart5/{id}','TblController5@getepozcart')->name('moreCart5');
        Route::get('lessfood5/{id}','TblController5@reduceFood')->name('lessfood5');
        Route::post('cashchange5','TblController5@paidStore')->name('tblpaid5');
        Route::get('tblcard5','TblController5@card')->name('tblcard5');
        Route::get('tbl1clear5','TblController5@destroy')->name('destroy5');

        Route::post('discount5','TblController5@extraCash')->name('extraCash5');
        Route::post('open5','TblController5@open')->name('open5');

        Route::post('tbl_order5','TblController5@orderTbl')->name('order_tbl5');



        //tbl06

        Route::get('addservice6','TblController6@addServiceCharge')->name('addService6');

        Route::get('print',function (){
            return view('epoz.printPos');
        })->name('printPos2');
        Route::post('tbl6','TblController6@tblCart01')->name('tbl6');
        Route::get('tblindex6','TblController6@index')->name('index6');
        Route::get('tpoz6/{id}','TblController6@showEpoz')->name('epoz6');

        Route::get('less6/{id}','TblController6@getReduceByOne')->name('less6');
        Route::get('morecart6/{id}','TblController6@getepozcart')->name('moreCart6');
        Route::get('lessfood6/{id}','TblController6@reduceFood')->name('lessfood6');
        Route::post('cashchange6','TblController6@paidStore')->name('tblpaid6');
        Route::get('tblcard6','TblController6@card')->name('tblcard6');
        Route::get('tbl1clear6','TblController6@destroy')->name('destroy6');
        Route::post('discount6','TblController6@extraCash')->name('extraCash6');
        Route::post('open6','TblController6@open')->name('open6');
        Route::post('tbl_order6','TblController6@orderTbl')->name('order_tbl6');


          //tbl07

        Route::get('addservice7','TblController7@addServiceCharge')->name('addService7');

          Route::get('print',function (){
            return view('epoz.printPos');
        })->name('printPos2');
        Route::post('tbl7','TblController7@tblCart01')->name('tbl7');
        Route::get('tblindex7','TblController7@index')->name('index7');
        Route::get('tpoz7/{id}','TblController7@showEpoz')->name('epoz7');

        Route::get('less7/{id}','TblController7@getReduceByOne')->name('less7');
        Route::get('morecart7/{id}','TblController7@getepozcart')->name('moreCart7');
        Route::get('lessfood7/{id}','TblController7@reduceFood')->name('lessfood7');
        Route::post('cashchange7','TblController7@paidStore')->name('tblpaid7');
        Route::get('tblcard7','TblController7@card')->name('tblcard7');
        Route::get('tbl1clear7','TblController7@destroy')->name('destroy7');

        Route::post('discount7','TblController7@extraCash')->name('extraCash7');
        Route::post('open7','TblController7@open')->name('open7');


        Route::post('tbl_order7','TblController7@orderTbl')->name('order_tbl7');



        // epoz end


    });

    Route::get('all_blogs','BlogController@search')->name('blogs');
    Route::get('/category/{id}', 'BlogController@cat')->name('categ');
    Route::get('blog/{id}', 'BlogController@blog')->name('blog');
    Route::get('lifestyle', 'BlogController@lifestyle')->name('lifestyle');
    Route::get('/search', 'BlogController@search')->name('search');

    //------------------------------------------------------------------------ + --------------------------------------------------------------
           Route::view('booking','user.booking')->name('booking');


    //epoz

    Route::get('print',function (){
        return view('epoz.printPos');
    })->name('printPos');
    // Route::view('epoz','epoz.index',['foods'=>''])->name('epozHome');
//     Route::get('epoz','epozCartController@index')->name('epozHome');
//     Route::get('epos','epozCartController@index1')->name('epozHome2');
//     Route::get('epoz/{id}','User\NewFoodController@showEpoz')->name('epoz');
//     Route::get('pozcart/{id}','epozCartController@getepozcart')->name('epozCart');

//     Route::get('epozreduce/{id}','epozCartController@getReduceByOne')->name('reduceEpoz');

//     Route::get('clear','epozCartController@destroy')->name('destroyall');

//     Route::post('tbl','epozCartController@tblno')->name('tblno');


//     Route::get('',function (){

//         $change = Session::get('change');
//         return view('epoz.printPos',['change'=>$change]);
//     });

//     Route::get('cash','epozCartController@cash')->name('cash');

//     Route::get('card','epozCartController@card')->name('card');

//     Route::get('payments','epozCartController@payments')->name('payments');

//     Route::get('show_edit',function (){
//         return view('epoz.edit_discount');
//     })->name('showedit');

//     Route::get('edit_discount/{id}','epozCartController@editDiscount')->name('editdiscount');

//     Route::put('updatediscount/{id}','epozCartController@updateDiscount')->name('updatediscount');

//     Route::post('cashdiscount','epozCartController@extraCash')->name('extraCash');
//     Route::post('open','epozCartController@open')->name('open');

//     Route::get('show_tax',function (){
//         return view('epoz.tax');
//     })->name('tax');

//     Route::get('edit/tax/{id}','epozCartController@editTax')->name('editTax');

//     Route::put('update_tax/{id}','epozCartController@updateTax')->name('updateTax');

//     Route::post('change','epozCartController@paidStore')->name('paid');

//     Route::get('payments/refund/{id}','epozCartController@redfundPayments')->name('refund');

//     Route::get('reducefood/{id}','epozCartController@reduceFood')->name('reduce');

//     Route::post('months','epozCartController@monthly')->name('months');

//     Route::post('tbl_order','epozCartController@orderTbl')->name('order_tbl');


//     //tbl01
// Route::get('print',function (){
//     return view('epoz.printPos');
// })->name('printPos1');
//     Route::get('tblindex1','TblController1@index')->name('index1');
//     Route::get('tpoz1/{id}','TblController1@showEpoz1')->name('epoz1');
//     Route::get('morecart/{id}','TblController1@getepozcart')->name('moreCart');
//     Route::post('cashdiscount1','TblController1@extraCash')->name('extraCash1');
//     Route::post('open1','TblController1@open')->name('open1');

//     Route::get('addservice1','TblController1@addServiceCharge')->name('addService1');

//     // Route::put('updatediscount1/{id}','TblController1@updateDiscount')->name('updatediscount1');

//    Route::post('tbl1','TblController1@tblCart01')->name('tbl1');
//     Route::get('data','TblController1@gettbl')->name('gtbl');
//     Route::get('less/{id}','TblController1@getReduceByOne')->name('less');
//     Route::get('morecart/{id}','TblController1@getepozcart')->name('moreCart');
//     Route::get('lessfood/{id}','TblController1@reduceFood')->name('lessfood');
//     Route::post('change1','TblController1@paidStore')->name('tblpaid1');
//     Route::get('tblcard','TblController1@card')->name('tblcard1');
//     Route::get('printcardcash1','TblController1@printCashCard')->name('printcard1');

//     Route::get('tbl1clear','TblController1@destroy')->name('destroy1');

//     Route::post('tbl_order1','TblController1@orderTbl')->name('order_tbl1');
//     //tbl02

//     Route::get('addservice2','TblController2@addServiceCharge')->name('addService2');


//     Route::get('print',function (){
//         return view('epoz.printPos');
//     })->name('printPos2');
//     Route::post('tbl2','TblController2@tblCart01')->name('tbl2');
//     Route::get('tblindex2','TblController2@index')->name('index2');
//     Route::get('tpoz2/{id}','TblController2@showEpoz')->name('epoz2');

//     Route::get('less2/{id}','TblController2@getReduceByOne')->name('less2');
//     Route::get('morecart2/{id}','TblController2@getepozcart')->name('moreCart2');
//     Route::get('lessfood2/{id}','TblController2@reduceFood')->name('lessfood2');
//     Route::post('cashchange2','TblController2@paidStore')->name('tblpaid2');
//     Route::get('tblcard2','TblController2@card')->name('tblcard2');
//     Route::get('tbl1clear2','TblController2@destroy')->name('destroy2');

//     Route::post('discount2','TblController2@extraCash')->name('extraCash2');
//     Route::post('open2','TblController2@open')->name('open2');

//     Route::post('tbl_order2','TblController2@orderTbl')->name('order_tbl2');


//     //tbl03


//     Route::get('addservice3','TblController3@addServiceCharge')->name('addService3');
//     Route::get('print',function (){
//         return view('epoz.printPos');
//     })->name('printPos2');
//     Route::post('tbl3','TblController3@tblCart01')->name('tbl3');
//     Route::get('tblindex3','TblController3@index')->name('index3');
//     Route::get('tpoz3/{id}','TblController3@showEpoz')->name('epoz3');

//     Route::get('less3/{id}','TblController3@getReduceByOne')->name('less3');
//     Route::get('morecart3/{id}','TblController3@getepozcart')->name('moreCart3');
//     Route::get('lessfood3/{id}','TblController3@reduceFood')->name('lessfood3');
//     Route::post('cashchange3','TblController3@paidStore')->name('tblpaid3');
//     Route::get('tblcard3','TblController3@card')->name('tblcard3');
//     Route::get('tbl1clear3','TblController3@destroy')->name('destroy3');

//     Route::post('discount3','TblController3@extraCash')->name('extraCash3');
//     Route::post('open3','TblController3@open')->name('open3');
//     Route::post('tbl_order3','TblController3@orderTbl')->name('order_tbl3');

//     //tbl04

//     Route::get('addservice4','TblController4@addServiceCharge')->name('addService4');
//     Route::get('print',function (){
//         return view('epoz.printPos');
//     })->name('printPos2');
//     Route::post('tbl4','TblController4@tblCart01')->name('tbl4');
//     Route::get('tblindex4','TblController4@index')->name('index4');
//     Route::get('tpoz4/{id}','TblController4@showEpoz')->name('epoz4');

//     Route::get('less4/{id}','TblController4@getReduceByOne')->name('less4');
//     Route::get('morecart4/{id}','TblController4@getepozcart')->name('moreCart4');
//     Route::get('lessfood4/{id}','TblController4@reduceFood')->name('lessfood4');
//     Route::post('cashchange4','TblController4@paidStore')->name('tblpaid4');
//     Route::get('tblcard4','TblController4@card')->name('tblcard4');
//     Route::get('tbl1clear4','TblController4@destroy')->name('destroy4');
//     Route::post('discount4','TblController4@extraCash')->name('extraCash4');
//     Route::post('open4','TblController4@open')->name('open4');
//     Route::post('tbl_order4','TblController4@orderTbl')->name('order_tbl4');




//     //tbl05

//     Route::get('addservice5','TblController5@addServiceCharge')->name('addService5');

//      Route::get('print',function (){
//         return view('epoz.printPos');
//     })->name('printPos2');
//     Route::post('tbl5','TblController5@tblCart01')->name('tbl5');
//     Route::get('tblindex5','TblController5@index')->name('index5');
//     Route::get('tpoz5/{id}','TblController5@showEpoz')->name('epoz5');

//     Route::get('less5/{id}','TblController5@getReduceByOne')->name('less5');
//     Route::get('morecart5/{id}','TblController5@getepozcart')->name('moreCart5');
//     Route::get('lessfood5/{id}','TblController5@reduceFood')->name('lessfood5');
//     Route::post('cashchange5','TblController5@paidStore')->name('tblpaid5');
//     Route::get('tblcard5','TblController5@card')->name('tblcard5');
//     Route::get('tbl1clear5','TblController5@destroy')->name('destroy5');

//     Route::post('discount5','TblController5@extraCash')->name('extraCash5');
//     Route::post('open5','TblController5@open')->name('open5');

//     Route::post('tbl_order5','TblController5@orderTbl')->name('order_tbl5');



//     //tbl06

//     Route::get('addservice6','TblController6@addServiceCharge')->name('addService6');

//     Route::get('print',function (){
//         return view('epoz.printPos');
//     })->name('printPos2');
//     Route::post('tbl6','TblController6@tblCart01')->name('tbl6');
//     Route::get('tblindex6','TblController6@index')->name('index6');
//     Route::get('tpoz6/{id}','TblController6@showEpoz')->name('epoz6');

//     Route::get('less6/{id}','TblController6@getReduceByOne')->name('less6');
//     Route::get('morecart6/{id}','TblController6@getepozcart')->name('moreCart6');
//     Route::get('lessfood6/{id}','TblController6@reduceFood')->name('lessfood6');
//     Route::post('cashchange6','TblController6@paidStore')->name('tblpaid6');
//     Route::get('tblcard6','TblController6@card')->name('tblcard6');
//     Route::get('tbl1clear6','TblController6@destroy')->name('destroy6');
//     Route::post('discount6','TblController6@extraCash')->name('extraCash6');
//     Route::post('open6','TblController6@open')->name('open6');
//     Route::post('tbl_order6','TblController6@orderTbl')->name('order_tbl6');


//       //tbl07

//     Route::get('addservice7','TblController7@addServiceCharge')->name('addService7');

//       Route::get('print',function (){
//         return view('epoz.printPos');
//     })->name('printPos2');
//     Route::post('tbl7','TblController7@tblCart01')->name('tbl7');
//     Route::get('tblindex7','TblController7@index')->name('index7');
//     Route::get('tpoz7/{id}','TblController7@showEpoz')->name('epoz7');

//     Route::get('less7/{id}','TblController7@getReduceByOne')->name('less7');
//     Route::get('morecart7/{id}','TblController7@getepozcart')->name('moreCart7');
//     Route::get('lessfood7/{id}','TblController7@reduceFood')->name('lessfood7');
//     Route::post('cashchange7','TblController7@paidStore')->name('tblpaid7');
//     Route::get('tblcard7','TblController7@card')->name('tblcard7');
//     Route::get('tbl1clear7','TblController7@destroy')->name('destroy7');

//     Route::post('discount7','TblController7@extraCash')->name('extraCash7');
//     Route::post('open7','TblController7@open')->name('open7');


//     Route::post('tbl_order7','TblController7@orderTbl')->name('order_tbl7');



//     // --------------------------------------------------------------------------------------------------------------------------------------------------







    //user

   // Route::get('/','User\MenuController@showMenu')->name('myhome');

    Route::get('item/{id}','User\MenuController@showItemMenu')->name('item');

    Route::get('cart/{id}','User\CartController@getAddToCart')->name('addToCart');

    Route::get('removefood/{id}','User\CartController@removeFood')->name('remove');


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

    Route::post('customer-add','admin\CustomerController@store');

    //topping cart


    Route::get('/topping', 'ToppingCartController@index');

    Route::get('topping-cart', 'ToppingCartController@cart')->name('topping-cart');

    Route::get('add-to-cart/{id}', 'ToppingCartController@addToCart')->name('add-to-cart');

    Route::patch('update-cart', 'ToppingCartController@update');

    Route::delete('remove-from-cart', 'ToppingCartController@remove');

    //new-food


    Route::view('newfood','user.newFood.index',['foods'=>'','order'=>''])->name('menu');
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
    Route::get('clearcart','User\CartController@destroy')->name('clearCart');
    //order
    Route::post('order-send','Admin\CustomerOrderController@orderDone')->name('order-done');
    Route::get('order/complete/{id}','Admin\CustomerOrderController@OrderComplete')->name('order.complete');

    //paypal

    Route::get('/execute-payment','PaymentController@execute');
    Route::post('/create-payment','PaymentController@create')->name('create-payment');


    Route::post('delivery_charge','User\OrderTypeController@delivery')->name('delivery');


    //checkout
    Route::get('completecheckout','User\CartController@orderProcess')->name('orderProcess');
    Route::get('processcart/{id}','User\CartController@cartProcess')->name('cartProcess');

    Route::view('checkout','user.checkout.index')->name('checkout');
    Route::get('updatechecout','User\CartController@Updatecheckout')->name('updatecheckout');


    Route::post('ordercomplete','CustomerCheckoutController@orderDone')->name('checkout-done');
    Route::get('order/complete/{id}','CustomerCheckoutController@OrderComplete')->name('checkout.complete');

//    Route::get('Ordercheckout','User\CartController@checkout')->name('processCheckout');

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
