<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\epozDiscount;
use App\epozTax;
use App\Paid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\PaymentStatus;
use App\epozCart;
use App\Customer;
use App\Food;
use App\FoodItem;
use App\Menu;
use App\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class TblController6 extends Controller
{


    public function addServiceCharge() {
        $service_charge =DB::table('service_charge')->value('charge');

        //dd($service_charge);
        Session::put('service6', $service_charge);
        Session::save();

        return redirect()->back();
        }

    public function orderTbl(Request $request)
    {
        
    
        $person = $request->input('person');

        Session::put('person6', $person);
        Session::save();
       return redirect()->back();
    }

    public function gettbl()
    {
        
       return view('epoz/tbl6');
        
    }
    public function showEpoz($id)
    {
        // selecting all food item
        
        $discount = DB::table('epoz_discounts')->where('id', 1)->first();
        $foods = Food::where('menu_id', '=', $id)->get();
        //dd($foods);
        return view('epoz.tblcart6',compact('foods','discount'));
    }
    public function tblCart01(Request $request)
    {
        $cart = Session::has('ecart') ? Session:: get('ecart') : null;
        $request->session()->put('tbl6', $cart);
        $tbl_no= $request->input('tbl_no');
        $person = $request->input('person');
        Session::put('tbl_no', $tbl_no);
        Session::save();
        Session::put('person', $person);
        Session::save();
        Session::put('tbl_no6', $tbl_no);
        Session::save();
        Session::put('person6', $person);
        Session::save();
       return redirect()->back();
        
    }
    
    
    public function getepozcart(Request $request, $id)
    {
        $foods = Food::findOrFail($id);
        
        
        $oldCart = Session::has('tbl6') ? Session:: get('tbl6') : null;
        
        $cart = new epozCart($oldCart);
        
        $cart->add($foods, $foods->id);
        $items=$cart->items;
        foreach($items as $item) {
            // dd($item['item']);
            Order::create([
                'price' => $item['item']['price'],
                'quantity' => $item['item']['price']
            ]);
        }
        
        //$foods= FoodItem::all();
        $request->session()->put('tbl6', $cart);
        //dd($request->session()->get('ecart'));
        //return view('user.newFood.index');
        return redirect()->back();
    }
    
    public function getReduceByOne($id) {
        $oldCart = Session::has('tbl6') ? Session::get('tbl6') : null;
        $cart = new epozCart($oldCart);
        $cart->reduceByOne($id);
        if (count($cart->items) > 0) {
            Session::put('tbl6', $cart);
        } else {
            Session::forget('tbl6');
        }
//            return redirect()->route('cart');
        return redirect()->back();
        
    }

    public function reduceFood($id) {

        if(Session::has('tbl6')){
            $oldCart = Session::get('tbl6');
        
            $products = $oldCart->items;
            $total = $oldCart->totalPrice - $oldCart->items[$id]['price'];
            $oldCart->totalPrice =$total;
            $items = $oldCart->items[$id]['qty'];

            unset($oldCart->items[$id]);
        
    
            $oldCart = Session::has('tbl6') ? Session::get('tbl6') : null;
          

            session(['tbl6' => $oldCart,]);
        
        
            if(!$oldCart->items){
                Session::put('paid', 0);
                Session::save();
    
                Session::put('change',0);
                Session::save();
                return redirect('tblindex6');

            }
            // Session::put('paid', 0);
            // Session::save();

            // Session::put('change',0);
            // Session::save();
            return redirect()->back();

        }else{
           
            // $paid = 0.00;
            // $change=0.00;
            Session::put('paid', 0);
            Session::save();

            Session::put('change',0);
            Session::save();
            $totalPrice=0;
            return redirect('tblindex6')->with('totalPrice', $totalPrice);
            
        }
       
        // return redirect('epoz');
        
      
    }


    
    public function destroy(Request $request)
    {
        $request->session()->forget('tbl6');
        $request->session()->forget('paid6');
        $request->session()->forget('change6');
        $request->session()->forget('open6');
        $request->session()->forget('extra6');
        $request->session()->forget('person6');
        $request->session()->forget('service6');
        $request->session()->forget('cash6');
        $request->session()->forget('card6');


        Session::regenerate(true);
       
        return redirect()->back();
        // return redirect('epoz');
    
    }
    
    public function print()
    {
        $students = Student::all();
        $change = Session::get('change');
        return view('students')->with('students', $students);
    }
    
    public function card()
    {
        $pay = Session::get('paid6');  
        $changes = Session::get('change6');
        $ordered_food_name = Session::get('name_items6');
        $price = Session::get('price_items6');
        $qty = Session::get('qty_items6');
        
        
        
         $x = implode(",",$ordered_food_name);
         $p = implode(",",$price);
         $q = implode(",",$qty);
        
         $dis_p = DB::table('percent_dis')->where('id','=', 1)->value('percent');



        
        
        
        Session::put('card6','Card');
        Session::save();
        session()->forget(['cash6']);
        $oldCart = Session::get('tbl6');
        
        $cart = new epozCart($oldCart);
        $totalPrice= $cart->totalPrice;
        $dis = epozDiscount::find(1);
        $tax = epozTax::find(1);
        $open = Session::get('open6');
        $extra = Session::get('extra6');
        $tbl_no = Session::get('tbl_no6');
        $person = Session::get('person6');
        $service = Session::get('service6');

        if($open && $extra){
            $totalPrice =$totalPrice+$open;
            // $afterDiscount=$totalPrice-($totalPrice*($dis->discount/100));
            $disTotal=$totalPrice-$extra;
            $last1=$disTotal+($disTotal*($tax->tax/100));
            $last = $last1+($last1*($service/100)) ;
            PaymentStatus::create([
                'order_id'=>substr(Session::getId(),0,4),
                'amount' => $last,
                'method' => 'card',
                'table_no'=>$tbl_no,
                'person'=>$person,
                'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,
                'openfood'=>$open,
                'dis_percent'=>$dis_p,
                'dis_cash'=>$extra,
                'paid'=>$pay,
                'change_cash'=>$changes,


            ]);
    
        return redirect()->back();
        }elseif($open && $dis->discount){
            $totalPrice = $totalPrice+$open;
            $disTotal=$totalPrice-($totalPrice*($dis->discount/100));
             $last1=$disTotal+($disTotal*($tax->tax/100));
            $last = $last1+($last1*($service/100)) ;
            PaymentStatus::create([
                'order_id'=>substr(Session::getId(),0,4),
                'amount' => $last,
                'method' => 'card',
                'table_no'=>$tbl_no,
                'person'=>$person,
                 'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,
                'openfood'=>$open,
                'dis_percent'=>$dis_p,
                'dis_cash'=>$extra,
                'paid'=>$pay,
                'change_cash'=>$changes,
            ]);
    
        return redirect()->back();

        }elseif($extra){
            $disTotal =$totalPrice-$extra;
           $last1=$disTotal+($disTotal*($tax->tax/100));
            $last = $last1+($last1*($service/100)) ;
            PaymentStatus::create([
            'order_id'=>substr(Session::getId(),0,4),
            'amount' => $last,
            'method' => 'card',
            'table_no'=>$tbl_no,
            'person'=>$person,
             'ordered_food'=>$x,
            'quantity' => $q,
            'price'=>$p,
            'openfood'=>$open,
            'dis_percent'=>$dis_p,
            'dis_cash'=>$extra,
            'paid'=>$pay,
            'change_cash'=>$changes,
    ]);

        return redirect()->back();

        }elseif($dis->discount){
            $disTotal=$totalPrice-($totalPrice*($dis->discount/100));
            $last1=$disTotal+($disTotal*($tax->tax/100));
            $lastPrice = $last1+($last1*($service/100));
                PaymentStatus::create([
                    'order_id'=>substr(Session::getId(),0,4),
                    'amount' => $lastPrice,
                    'method' => 'card',
                    'table_no'=>$tbl_no,
                    'person'=>$person,
                     'ordered_food'=>$x,
                    'quantity' => $q,
                    'price'=>$p,
                    'openfood'=>$open,
                    'dis_percent'=>$dis_p,
                    'dis_cash'=>$extra,
                    'paid'=>$pay,
                    'change_cash'=>$changes,
                ]);
        
            return redirect()->back();

        }elseif($open){
            $disTotal=$totalPrice+$open;
            $last1=$disTotal+($disTotal*($tax->tax/100));
            $lastPrice = $last1+($last1*($service/100));
                PaymentStatus::create([
                    'order_id'=>substr(Session::getId(),0,4),
                    'amount' => $lastPrice,
                    'method' => 'card',
                    'table_no'=>$tbl_no,
                    'person'=>$person,
                     'ordered_food'=>$x,
                    'quantity' => $q,
                    'price'=>$p,
                    'openfood'=>$open,
                    'dis_percent'=>$dis_p,
                    'dis_cash'=>$extra,
                    'paid'=>$pay,
                    'change_cash'=>$changes,
                ]);
        
            return redirect()->back();

        }else{

            $totalPrice=$totalPrice+($totalPrice*($tax->tax/100));
             $lastPrice = $totalPrice+($totalPrice*($service/100));
            PaymentStatus::create([
                'order_id'=>substr(Session::getId(),0,4),
                'amount' => $lastPrice,
                'method' => 'card',
                'table_no'=>$tbl_no,
                'person'=>$person,
                 'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,
                'openfood'=>$open,
                'dis_percent'=>$dis_p,
                'dis_cash'=>$extra,
                'paid'=>$pay,
                'change_cash'=>$changes,
            ]);
    
            return redirect()->back();
        }

        
    
    }
    
    public function cash()
    {
        $pay = Session::get('paid6');  
        $changes = Session::get('change6');
         
        
        
        $ordered_food_name = Session::get('name_items6');
        $price = Session::get('price_items6');
        $qty = Session::get('qty_items6');
        
        
        
         $x = implode(",",$ordered_food_name);
         $p = implode(",",$price);
         $q = implode(",",$qty);
        
         $dis_p = DB::table('percent_dis')->where('id','=', 1)->value('percent');


        
        
        
        Session::put('cash6','Cash');
        Session::save();
        session()->forget(['card6']);
        $oldCart = Session::get('tbl6');
        
        $cart = new epozCart($oldCart);
        $totalPrice= $cart->totalPrice;
        $dis = epozDiscount::find(1);
        $tax = epozTax::find(1);
        $open = Session::get('open6');
        $extra = Session::get('extra6');
        $tbl_no = Session::get('tbl_no6');
        $person = Session::get('person6');
         $service = Session::get('service6');

        if($open && $extra){
            $totalPrice =$totalPrice+$open;
            // $afterDiscount=$totalPrice-($totalPrice*($dis->discount/100));
            $disTotal=$totalPrice-$extra;
            $last1=$disTotal+($disTotal*($tax->tax/100));
            $last = $last1+($last1*($service/100)) ;
            PaymentStatus::create([
                'order_id'=>substr(Session::getId(),0,4),
                'amount' => $last,
                'method' => 'cash',
                'table_no'=>$tbl_no,
                'person'=>$person,
                'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,
                'openfood'=>$open,
                'dis_percent'=>$dis_p,
                'dis_cash'=>$extra,
                'paid'=>$pay,
                'change_cash'=>$changes,
            ]);
    
        return redirect()->back();
        }elseif($open && $dis->discount){
            $totalPrice = $totalPrice+$open;
            $disTotal=$totalPrice-($totalPrice*($dis->discount/100));
           $last1=$disTotal+($disTotal*($tax->tax/100));
            $last = $last1+($last1*($service/100)) ;
            PaymentStatus::create([
                'order_id'=>substr(Session::getId(),0,4),
                'amount' => $last,
                'method' => 'cash',
                'table_no'=>$tbl_no,
                'person'=>$person,
                'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,
                'openfood'=>$open,
                'dis_percent'=>$dis_p,
                'dis_cash'=>$extra,
                'paid'=>$pay,
                'change_cash'=>$changes,
            ]);
    
        return redirect()->back();

        }elseif($extra){
            $disTotal =$totalPrice-$extra;
           $last1=$disTotal+($disTotal*($tax->tax/100));
            $last = $last1+($last1*($service/100)) ;
            PaymentStatus::create([
            'order_id'=>substr(Session::getId(),0,4),
            'amount' => $last,
            'method' => 'cash',
            'table_no'=>$tbl_no,
            'person'=>$person,
            'ordered_food'=>$x,
            'quantity' => $q,
            'price'=>$p,
            'openfood'=>$open,
            'dis_percent'=>$dis_p,
            'dis_cash'=>$extra,
            'paid'=>$pay,
            'change_cash'=>$changes,
        ]);

        return redirect()->back();

        }elseif($dis->discount){
            $disTotal=$totalPrice-($totalPrice*($dis->discount/100));
             $last1=$disTotal+($disTotal*($tax->tax/100));
            $lastPrice = $last1+($last1*($service/100));
                PaymentStatus::create([
                    'order_id'=>substr(Session::getId(),0,4),
                    'amount' => $lastPrice,
                    'method' => 'cash',
                    'table_no'=>$tbl_no,
                    'person'=>$person,
                    'ordered_food'=>$x,
                    'quantity' => $q,
                    'price'=>$p,
                    'openfood'=>$open,
                    'dis_percent'=>$dis_p,
                    'dis_cash'=>$extra,
                    'paid'=>$pay,
                    'change_cash'=>$changes,
                ]);
        
            return redirect()->back();

        }elseif($open){
            $disTotal=$totalPrice+$open;
           $last1=$disTotal+($disTotal*($tax->tax/100));
            $lastPrice = $last1+($last1*($service/100));
                PaymentStatus::create([
                    'order_id'=>substr(Session::getId(),0,4),
                    'amount' => $lastPrice,
                    'method' => 'cash',
                    'table_no'=>$tbl_no,
                    'person'=>$person,
                    'ordered_food'=>$x,
                    'quantity' => $q,
                    'price'=>$p,
                    'openfood'=>$open,
                    'dis_percent'=>$dis_p,
                    'dis_cash'=>$extra,
                    'paid'=>$pay,
                    'change_cash'=>$changes,
                ]);
        
            return redirect()->back();

        }else{

            $totalPrice=$totalPrice+($totalPrice*($tax->tax/100));
            $lastPrice = $totalPrice+($totalPrice*($service/100));
            PaymentStatus::create([
                'order_id'=>substr(Session::getId(),0,4),
                'amount' => $lastPrice,
                'method' => 'cash',
                'table_no'=>$tbl_no,
                'person'=>$person,
                'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,
                'openfood'=>$open,
                'dis_percent'=>$dis_p,
                'dis_cash'=>$extra,
                'paid'=>$pay,
                'change_cash'=>$changes,
            ]);
    
            return redirect()->back();
        }

        
        
    }
    
    public function payments()
    {
        //$requested_month=  $request->input('months');
        $discount = DB::table('epoz_discounts')->where('id', 1)->first();
        $tax = DB::table('epoz_taxes')->where('id', 1)->first();

        $open = Session::get('open6');
        $extra = Session::get('extra6');
     
         

        $statuses = PaymentStatus::all();
        
        // $statuses = count($status);
        
        $todays =DB::table('payment_statuses')->whereDay('created_at', '=', date('d'))->get();
        $months =DB::table('payment_statuses')->whereMonth('created_at', '=', date('m'))->get();
        $years = DB::table('payment_statuses')->whereYear('created_at', '=', date('Y'))->get();
        
        $cashdays =DB::table('payment_statuses')->whereDay('created_at', '=', date('d'))->where('method', 'cash')->get();
        $carddays =DB::table('payment_statuses')->whereDay('created_at', '=', date('d'))->where('method', 'card')->get();

       // $r_month = DB::table('payment_statuses')->whereMonth('created_at', '=', date($requested_month))->get();

        // if($r_month){
        //     $month_name = DB::table('months')->where('id', $requested_month)->value('name');
        //     $statuses = DB::table('payment_statuses')->whereMonth('created_at', '=', date($requested_month))->get();
        
        // }else{
        //     $month_name = DB::table('months')->where('id',date('m'))->value('name');
        //     $statuses = DB::table('payment_statuses')->whereMonth('created_at', '=', date('m'))->get();

        // }

   
        
        $month_name = DB::table('months')->where('id',date('m'))->value('name');
        $statuses = DB::table('payment_statuses')->whereMonth('created_at', '=', date('m'))->get();
        
        
        $cashmonths =DB::table('payment_statuses')->whereMonth('created_at', '=', date('m'))->where('method', 'cash')->get();
        $cardmonths =DB::table('payment_statuses')->whereMonth('created_at', '=', date('m'))->where('method', 'card')->get();
       
   
  

        $cashyears =DB::table('payment_statuses')->whereYear('created_at', '=', date('Y'))->where('method', 'cash')->get();
        $cardyears =DB::table('payment_statuses')->whereYear('created_at', '=', date('Y'))->where('method', 'card')->get();
        
        $all_months = DB::table('months')->get();

        $totalamount=0;
        $totalmonths=0;
        $totalyears=0;


        $totalCashofDays =0;
        $totalCardofDays =0;


        $totalCashofMonths =0;
        $totalCardofMonths =0;

        $totalCashofYears =0;
        $totalCardofYears =0;
        
        
         foreach($cashdays as $cashday){
            $totalCashofDays += $cashday->amount;


        }

        foreach($carddays as $cardday){
            $totalCardofDays += $cardday->amount;


        }

        
        foreach($cashmonths as $cashmonth){
            $totalCashofMonths += $cashmonth->amount;
            }
        
        
        foreach($cardmonths as $cardmonth){
            $totalCardofMonths += $cardmonth->amount;


        }


        foreach($cashyears as $cashyear){
            $totalCashofYears += $cashyear->amount;


        }

        foreach($cardyears as $cardyear){
            $totalCardofYears += $cardyear->amount;


        }

        

        foreach($todays as $today){
            $totalamount += $today->amount;


        }
        foreach($months as $month){
            $totalmonths += $month->amount;


        }
        foreach($years as $year){
            $totalyears += $year->amount;
        }
        
      
       
        
         return view('epoz/status',compact('discount','tax','open','extra','statuses','totalamount','totalmonths','totalyears','totalCashofMonths','totalCardofMonths','totalCashofDays','totalCardofDays','totalCardofYears','totalCashofYears','all_months','month_name'));



    }
    
    
     public function monthly(Request $request)
    {
        $requested_month=  $request->input('months');
        $discount = DB::table('epoz_discounts')->where('id', 1)->first();
        $tax = DB::table('epoz_taxes')->where('id', 1)->first();

        $open = Session::get('open6');
        $extra = Session::get('extra6');
     
         

      //  $statuses = PaymentStatus::all();
        
        // $statuses = count($status);
        
        $todays =DB::table('payment_statuses')->whereDay('created_at', '=', date('d'))->get();
        $months =DB::table('payment_statuses')->whereMonth('created_at', '=', date('m'))->get();
        $years = DB::table('payment_statuses')->whereYear('created_at', '=', date('Y'))->get();
        
        $cashdays =DB::table('payment_statuses')->whereDay('created_at', '=', date('d'))->where('method', 'cash')->get();
        $carddays =DB::table('payment_statuses')->whereDay('created_at', '=', date('d'))->where('method', 'card')->get();

        $r_month = DB::table('payment_statuses')->whereMonth('created_at', '=', date($requested_month))->get();

     

        $month_name = DB::table('months')->where('id', $requested_month)->value('name');
        $statuses = DB::table('payment_statuses')->whereMonth('created_at', '=', date($requested_month))->get();
        
        $cashmonths =DB::table('payment_statuses')->whereMonth('created_at', '=', date($requested_month))->where('method', 'cash')->get();
        $cardmonths =DB::table('payment_statuses')->whereMonth('created_at', '=', date($requested_month))->where('method', 'card')->get();
  
        
        // $month_name = DB::table('months')->where('id',date('m'))->value('name');
        // $statuses = DB::table('payment_statuses')->whereMonth('created_at', '=', date('m'))->get();
        // $cashmonths =DB::table('payment_statuses')->whereMonth('created_at', '=', date('m'))->where('method', 'cash')->get();
        // $cardmonths =DB::table('payment_statuses')->whereMonth('created_at', '=', date('m'))->where('method', 'card')->get();
       
  

        $cashyears =DB::table('payment_statuses')->whereYear('created_at', '=', date('Y'))->where('method', 'cash')->get();
        $cardyears =DB::table('payment_statuses')->whereYear('created_at', '=', date('Y'))->where('method', 'card')->get();
        
        $all_months = DB::table('months')->get();

        $totalamount=0;
        $totalmonths=0;
        $totalyears=0;


        $totalCashofDays =0;
        $totalCardofDays =0;


        $totalCashofMonths =0;
        $totalCardofMonths =0;

        $totalCashofYears =0;
        $totalCardofYears =0;
        
        
         foreach($cashdays as $cashday){
            $totalCashofDays += $cashday->amount;


        }

        foreach($carddays as $cardday){
            $totalCardofDays += $cardday->amount;


        }

        
        foreach($cashmonths as $cashmonth){
            $totalCashofMonths += $cashmonth->amount;
            }
        
        
        foreach($cardmonths as $cardmonth){
            $totalCardofMonths += $cardmonth->amount;


        }


        foreach($cashyears as $cashyear){
            $totalCashofYears += $cashyear->amount;


        }

        foreach($cardyears as $cardyear){
            $totalCardofYears += $cardyear->amount;


        }

        

        foreach($todays as $today){
            $totalamount += $today->amount;


        }
        
        $totalmonths = $totalCashofMonths +$totalCardofMonths;
        
        // foreach($months as $month){
        //     $totalmonths += $month->amount;


        // }
        foreach($years as $year){
            $totalyears += $year->amount;
        }
        
      
       
        
         return view('epoz/status',compact('discount','tax','open','extra','statuses','totalamount','totalmonths','totalyears','totalCashofMonths','totalCardofMonths','totalCashofDays','totalCardofDays','totalCardofYears','totalCashofYears','all_months','requested_month','month_name','r_month'));



        
    }
    
    public function editDiscount(Request $request,$id)
    {
        
        $discount = epozDiscount::findOrFail($id);
        
        return view('epoz/settings',compact('discount'));
    }
    
    public function updateDiscount(Request $request,$id)
    {
        $discount = epozDiscount::findOrFail($id);
        Session::put('percent', $discount);
        Session::save();
        $discount->Update($request->all());
        $foods ="";
        return redirect()->back();
        // return view('epoz/index',compact('discount','foods'));
    }
    
    public function storeDiscount(Request $request)
    {
        $input = $request->all();
        
        epozDiscount::create($input);
    
        return redirect('epoz');
    }
    
    
    public function editTax(Request $request,$id)
    {
        $tax = epozTax::findOrFail($id);
    
        return view('epoz/edit_tax',compact('tax'));
        
    }
    public function updateTax(Request $request,$id)
    {
        $tax = epozTax::findOrFail($id);
        $tax->Update($request->all());
        return redirect()->back();

        //return view('epoz/tax',compact('tax'));
    }
    
    public function paidStore(Request $request)
    {

      
        $paid = $request->input('paid');

        Session::put('paid6', $paid);
        Session::save();
        
        $total = $request->input('last');
        // $total = Session::get('total');

        // Session::put('nlast', $total);
        // Session::save();
        $newpay= Session::get('paid6');
        //dd($newpay);
        if($newpay){
            $change= $newpay-$total;
            Session::put('change6', $change);
            Session::save();
            TblController6::cash();
           
        }else{
             TblController6::cash();
            return redirect()->back();
        }
    
      
    
    
       return redirect()->back();
    
    }
    
    
    public function redfundPayments($id)
    {
        $data = PaymentStatus::findOrFail($id);
        $data->delete();
        
        return redirect()->back();
        
    }

    public function extraCash(Request $request)
    {
        $extra = $request->input('extra');
        Session::put('extra6', $extra);
        Session::save();
       
        return redirect('tblindex6');
    }

    public function open(Request $request)
    {
        $open = $request->input('open');
        Session::put('open6', $open);
        Session::save();
       
        return redirect('tblindex6');
    }

    public function tblno(Request $request)
    {
        $tbl_no = $request->input('tbl_no');
        Session::put('tbl_no', $tbl_no);
        Session::save();
       return redirect()->back();
        // return redirect('epoz');
    }
    
    public function index()
    {
        $discount = DB::table('epoz_discounts')->where('id', 1)->first();
        $tax = DB::table('epoz_taxes')->where('id', 1)->first();
        Session::put('tbl_no6', 6);
        Session::save();
        $open = Session::get('open6');
        $extra = Session::get('extra6');
     
        $last="";
        $foods='';
    
        return redirect('tpoz6/13')->with('discount','foods','tax','open','extra','foods','last');

        //return view('epoz/tblcart6',compact('discount','foods','tax','open','extra','foods','last'));
        // return redirect('epoz');
    }

    
}
