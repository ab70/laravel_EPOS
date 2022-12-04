<?php
    
    namespace App\Http\Controllers\User;
    
    use App\Cart;
    use App\Customer;
    use App\Food;
    use App\FoodItem;
    use App\Menu;
    use App\Order;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Validation\ValidationException;

    class CartController extends Controller
    {
        public function getAddToCart(Request $request, $id)
        {
            $foods = Food::findOrFail($id);
            
            
            $oldCart = Session::has('cart') ? Session:: get('cart') : null;
        
            $cart = new Cart($oldCart);
           
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
            $request->session()->put('cart', $cart);
            // dd($request->session()->get('cart'));
            //return view('user.newFood.index');
            return redirect()->back();
        }
        public function getCart()
        {
            if ( ! Session::has('cart')){
                return view ('user.newFood.index',['products'=>NULL]);
            }
           // $menus = Menu::all() ;
        
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
//            $foods = FoodItem::all();
    
          // dd($cart);
            return view ('user.newFood.index',['products'=>$cart->items,'totalPrice'=>$cart->totalPrice,]);
        
        
        }
        public function getReduceByOne($id) {
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->reduceByOne($id);
            if (count($cart->items) > 0) {
                Session::put('cart', $cart);
            } else {
                Session::forget('cart');
            }
//            return redirect()->route('cart');
            return redirect()->back();
    
        }
    
//        public function showOrderCart()
//        {
//            if ( ! Session::has('cart')){
//                return view ('user.newFood.index',['products'=>NULL]);
//            }
//
//
//            $oldCart = Session::get('cart');
//            $cart = new Cart($oldCart);
//
//            return view ('user.newFood.index',['products'=>$cart->items,'totalPrice'=>$cart->totalPrice]);
//
//
//        }
    
    
        public function orderType(Request $request)
        {
            $input = $request->all();
            dd($input);
            
            
        }
    
        public function orderDone()
        {
            if (Session::has('cart')) {
                $cartitems = Session::get('cart');
               //dd($cartitems->items['1']['qty']);
            foreach($cartitems->items as $item) {
                 //dd($item);
                Order::create([
                    'price' =>$item['price'] ,
                    'quantity' => $item['qty']
                ]);
            }
            }
        }
    
    
    
    }