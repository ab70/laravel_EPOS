<?php

namespace App\Http\Controllers;
use App\epozDiscount;
use App\epozTax;
use App\Paid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\PaymentStatus;
use Illuminate\Http\Request;
use App\epozCart;
use App\Customer;
use App\Food;
use App\FoodItem;
use App\Menu;
use App\Order;
use App\Tbl_order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class epozCartController extends Controller
{


    public function getepozcart(Request $request, $id)
    {
        $foods = Food::findOrFail($id);


        $oldCart = Session::has('ecart') ? Session:: get('ecart') : null;

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
        $request->session()->put('ecart', $cart);
        //dd($request->session()->get('ecart'));
        //return view('user.newFood.index');
        return redirect()->back();
    }

    public function getReduceByOne($id) {
        $oldCart = Session::has('ecart') ? Session::get('ecart') : null;
        $cart = new epozCart($oldCart);
        $cart->reduceByOne($id);
        if (count($cart->items) > 0) {
            Session::put('ecart', $cart);
        } else {
            Session::forget('ecart');
        }
//            return redirect()->route('cart');
        return redirect()->back();

    }

    public function reduceFood($id) {

        if(Session::has('ecart')){
            $oldCart = Session::get('ecart');

            $products = $oldCart->items;
            $total = $oldCart->totalPrice - $oldCart->items[$id]['price'];
            $oldCart->totalPrice =$total;
            $items = $oldCart->items[$id]['qty'];

            unset($oldCart->items[$id]);
            // unset($oldCart->items[$id]['qty']);
            // unset($oldCart->items[$id]['price']);


        //     if (is_array($items) || is_object($items))
        //     {
        //     foreach ($items as $item) {
        //         unset($oldCart->items[$id]);
        //         // unset($oldCart->item[$id]['item']);
        //         // unset($oldCart->item[$id]['price']);
        //         // unset($oldCart->item[$id]['qty']);
        //     }
        // }

            // for ($x = 0; $x <= $id; $x++) {
            //     unset($oldCart->items[$id]);
            //     unset($oldCart->items[$id]['item']['price']);
            // }




            // unset($oldCart->totalPrice);

            $oldCart = Session::has('ecart') ? Session::get('ecart') : null;
            // $totalPrice = Session::has('totalPrice') ? Session::get('totalPrice') : null;
            // $cart = new epozCart($oldCart);      //  unset($products[$id]); // Unset the index you want



            session(['ecart' => $oldCart,]);

        // $paid= Session::get('paid');
        // $change= Session::get('change');

        // unset($paid);
        // unset($change);

            // Session::set('ecart', $cart );
            if(!$oldCart->items){
                Session::put('paid', 0);
                Session::save();

                Session::put('change',0);
                Session::save();
                // return redirect('epoz');
                return redirect()->back();


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
            return redirect('epoz')->with('totalPrice', $totalPrice);

        }

        // return redirect('epoz');


    }



    public function destroy(Request $request)
    {
        $request->session()->forget('ecart');
         $request->session()->forget('card');
         $request->session()->forget('cash');


        Session::regenerate(true);
        $request->session()->flush();

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

        Session::put('card','Card');
        Session::save();
        session()->forget(['cash']);

        $oldCart = Session::get('ecart');
        $ordered_food_name = Session::get('name_items');
        $price = Session::get('price_items');
        $qty = Session::get('qty_items');

        $cart = new epozCart($oldCart);
        $totalPrice= $cart->totalPrice;
        $dis = epozDiscount::find(1);
        $tax = epozTax::find(1);
        $open = Session::get('open');
        $extra = Session::get('extra');
        $tbl_no = Session::get('tbl_no');
        $person = Session::get('person');


        $x = implode(",",$ordered_food_name);
        $p = implode(",",$price);
        $q = implode(",",$qty);
        if($open && $extra){
            $totalPrice =$totalPrice+$open;
            // $afterDiscount=$totalPrice-($totalPrice*($dis->discount/100));
            $disTotal=$totalPrice-$extra;
            $last=$disTotal+($disTotal*($tax->tax/100));
            PaymentStatus::create([
                'order_id'=>substr(Session::getId(),0,4),
                'amount' => $last,
                'method' => 'card',
                'table_no'=>$tbl_no,
                'person'=>$person,
                 'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,

            ]);

        return redirect()->back();
        }elseif($open && $dis->discount){
            $totalPrice = $totalPrice+$open;
            $disTotal=$totalPrice-($totalPrice*($dis->discount/100));
            $last=$disTotal+($disTotal*($tax->tax/100));
            PaymentStatus::create([
                'order_id'=>substr(Session::getId(),0,4),
                'amount' => $last,
                'method' => 'card',
                'table_no'=>$tbl_no,
                'person'=>$person,
                 'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,

            ]);

        return redirect()->back();

        }elseif($extra){
            $disTotal =$totalPrice-$extra;
            $last=$disTotal+($disTotal*($tax->tax/100));
            PaymentStatus::create([
            'order_id'=>substr(Session::getId(),0,4),
            'amount' => $last,
            'method' => 'card',
            'table_no'=>$tbl_no,
            'person'=>$person,
             'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,

        ]);

        return redirect()->back();

        }elseif($dis->discount){
            $disTotal=$totalPrice-($totalPrice*($dis->discount/100));
            $lastPrice=$disTotal+($disTotal*($tax->tax/100));
                PaymentStatus::create([
                    'order_id'=>substr(Session::getId(),0,4),
                    'amount' => $lastPrice,
                    'method' => 'card',
                    'table_no'=>$tbl_no,
                    'person'=>$person,
                     'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,

                ]);

            return redirect()->back();

        }elseif($open){
            $disTotal=$totalPrice+$open;
            $lastPrice=$disTotal+($disTotal*($tax->tax/100));
                PaymentStatus::create([
                    'order_id'=>substr(Session::getId(),0,4),
                    'amount' => $lastPrice,
                    'method' => 'card',
                    'table_no'=>$tbl_no,
                    'person'=>$person,
                     'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,

                ]);

            return redirect()->back();

        }else{

            $totalPrice=$totalPrice+($totalPrice*($tax->tax/100));
            PaymentStatus::create([
                'order_id'=>substr(Session::getId(),0,4),
                'amount' => $totalPrice,
                'method' => 'card',
                'table_no'=>$tbl_no,
                'person'=>$person,
                 'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,

            ]);

            return redirect()->back();
        }



    }

    public function cash()
    {

        Session::put('cash','Cash');
        Session::save();
        session()->forget(['card']);

        $oldCart = Session::get('ecart');

        $ordered_food_name = Session::get('name_items');
        $price = Session::get('price_items');
        $qty = Session::get('qty_items');

        $cart = new epozCart($oldCart);
        $totalPrice= $cart->totalPrice;
        $dis = epozDiscount::find(1);
        $tax = epozTax::find(1);
        $open = Session::get('open');
        $extra = Session::get('extra');
        $tbl_no = Session::get('tbl_no');
        $person = Session::get('person');

        $x = implode(",",$ordered_food_name);
        $p = implode(",",$price);
        $q = implode(",",$qty);
        if($open && $extra){
            $totalPrice =$totalPrice+$open;
            // $afterDiscount=$totalPrice-($totalPrice*($dis->discount/100));
            $disTotal=$totalPrice-$extra;
            $last=$disTotal+($disTotal*($tax->tax/100));
            PaymentStatus::create([
                'order_id'=>substr(Session::getId(),0,4),
                'amount' => $last,
                'method' => 'cash',
                'table_no'=>$tbl_no,
                'person'=>$person,
                 'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,
            ]);

        return redirect()->back();
        }elseif($open && $dis->discount){
            $totalPrice = $totalPrice+$open;
            $disTotal=$totalPrice-($totalPrice*($dis->discount/100));
            $last=$disTotal+($disTotal*($tax->tax/100));
            PaymentStatus::create([
                'order_id'=>substr(Session::getId(),0,4),
                'amount' => $last,
                'method' => 'cash',
                'table_no'=>$tbl_no,
                'person'=>$person,
                 'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,

            ]);

        return redirect()->back();

        }elseif($extra){
            $disTotal =$totalPrice-$extra;
            $last=$disTotal+($disTotal*($tax->tax/100));
            PaymentStatus::create([
            'order_id'=>substr(Session::getId(),0,4),
            'amount' => $last,
            'method' => 'cash',
            'table_no'=>$tbl_no,
            'person'=>$person,
             'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,

        ]);

        return redirect()->back();

        }elseif($dis->discount){
            $disTotal=$totalPrice-($totalPrice*($dis->discount/100));
            $lastPrice=$disTotal+($disTotal*($tax->tax/100));
                PaymentStatus::create([
                    'order_id'=>substr(Session::getId(),0,4),
                    'amount' => $lastPrice,
                    'method' => 'cash',
                    'table_no'=>$tbl_no,
                    'person'=>$person,
                     'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,

                ]);

            return redirect()->back();

        }elseif($open){
            $disTotal=$totalPrice+$open;
            $lastPrice=$disTotal+($disTotal*($tax->tax/100));
                PaymentStatus::create([
                    'order_id'=>substr(Session::getId(),0,4),
                    'amount' => $lastPrice,
                    'method' => 'cash',
                    'table_no'=>$tbl_no,
                    'person'=>$person,
                     'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,

                ]);

            return redirect()->back();

        }else{

            $totalPrice=$totalPrice+($totalPrice*($tax->tax/100));
            PaymentStatus::create([
                'order_id'=>substr(Session::getId(),0,4),
                'amount' => $totalPrice,
                'method' => 'cash',
                'table_no'=>$tbl_no,
                'person'=>$person,
                 'ordered_food'=>$x,
                'quantity' => $q,
                'price'=>$p,

            ]);

            return redirect()->back();
        }



    }

    public function payments()
    {
        //$requested_month=  $request->input('months');
        $discount = DB::table('epoz_discounts')->where('id', 1)->first();
        $tax = DB::table('epoz_taxes')->where('id', 1)->first();

        $open = Session::get('open');
        $extra = Session::get('extra');


        $statuses = DB::table('payment_statuses')->get();
       // $statuses = PaymentStatus::all();

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

        $open = Session::get('open');
        $extra = Session::get('extra');



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

        //$request->session()->put('paid',  $paid);
        Session::put('paid', $paid);
        Session::save();

        $total = $request->input('last');
        // $total = Session::get('total');

        // Session::put('nlast', $total);
        // Session::save();
        $newpay= Session::get('paid');
        //dd($newpay);
        if($newpay){
            $change= $newpay-$total;
            Session::put('change', $change);
            Session::save();
            epozCartController::cash();

        }else{
            epozCartController::cash();
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
        Session::put('extra', $extra);
        Session::save();

        return redirect('epoz');
    }

    public function open(Request $request)
    {
        $open = $request->input('open');
        Session::put('open', $open);
        Session::save();

        return redirect()->back();
    }

    public function tblno(Request $request)
    {
        $tbl_no = $request->input('tbl_no');
        Session::put('tbl_no', $tbl_no);
        Session::save();
       return redirect()->back();
        // return redirect('epoz');
    }

    public function orderTbl(Request $request)
    {

        $tbl_no = $request->input('tbl_no');
        $person = $request->input('person');

        Tbl_order::create([

            'tbl_no' => $tbl_no,
            'person' =>  $person,


        ]);

        Session::put('tbl_no', $tbl_no);
        Session::save();
        Session::put('person', $person);
        Session::save();
       return redirect()->back();
        // return redirect('epoz');
    }

    public function index()
    {
        $discount = DB::table('epoz_discounts')->where('id', 1)->first();
        $tax = DB::table('epoz_taxes')->where('id', 1)->first();

        $open = Session::get('open');
        $extra = Session::get('extra');

        $last="";
        $foods='';

        return redirect('tpoz1/13')->with('discount','foods','tax','open','extra','foods','last');

        //return view('epoz/tblcart1',compact('discount','foods','tax','open','extra','foods','last'));
        // return redirect('epoz');
    }

    public function index1()
    {
        $discount = DB::table('epoz_discounts')->where('id', 1)->first();
        $tax = DB::table('epoz_taxes')->where('id', 1)->first();

        $open = Session::get('open');
        $extra = Session::get('extra');

        $last="";
        $foods='';

        return redirect('epoz/13')->with('discount','foods','tax','open','extra','foods','last');


        //return view('epoz/index',compact('discount','foods','tax','open','extra','foods','last'));
        // return redirect('epoz');
    }





}
