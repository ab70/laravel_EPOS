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
    
    
        
        
        
//        public function getCart()
//        {
//            if ( ! Session::has('cart')){
//                return view ('user.newFood.index',['products'=>NULL]);
//            }
//           // $menus = Menu::all() ;
//
//            $oldCart = Session::get('cart');
//            $cart = new Cart($oldCart);
////            $foods = FoodItem::all();
//
//          // dd($cart);
//            return view ('user.newFood.index',['products'=>$cart->items,'totalPrice'=>$cart->totalPrice,]);
//
//
//        }
    
    
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
    
        public function orderProcess(Request $request)
        {
            $order = $request->input('order');
            
            
            //dd($order);
            //$pickup = $request->input('pickup');
          //  dd($delivery);
    
//            $delv=$request->session()->put('delivery', $delivery);
//            $pick=$request->session()->put('pickup', $pickup);
    
//            Session::put('delivery', $order);
//            Session::save();
    
//            return redirect('completecheckout')->with('order',$order);
           return view('user.checkout.index')->with('order',$order);
        
        }
        
        
        
        public function cartProcess(Request $request,$id)
        {
            $order = $request->input('order');
        
            Session::put('order', $order);
            Session::save();
            $foods = Food::where('menu_id', '=', $id)->get();
            

//            return redirect()->back()->with('order',$order,'foods',$foods);
            return redirect()->back()->with('foods', $foods)->withInput();
            //return view('user.newFood.cart',compact('order','foods'));
        }
    
//         public function cartProcess(Request $request)
//         {
//             $order = $request->input('order');
    
//             $foods = '';
// //            return redirect()->back()->with('order',$order,'foods',$foods);
    
//             return view('user.newFood.index',compact('order','foods'));
//         }
    
        public function checkout()
        {
          
          return view('user.checkout.index');
        }
    
        public function Updatecheckout(Request $request)
        {
            $order = $request->input('order');
            return redirect()->back()->with('order',$order);
        }
        public function destroy(Request $request)
        {
            $request->session()->forget('cart');
        
            $request->session()->flush();
        
            return redirect()->back();
        
        }
        public function removeFood($id) {
        
            if(Session::has('cart')){
                $oldCart = Session::get('cart');
            
                $products = $oldCart->items;
                $total = $oldCart->totalPrice - $oldCart->items[$id]['price'];
                $oldCart->totalPrice =$total;
                $items = $oldCart->items[$id]['qty'];
            
                unset($oldCart->items[$id]);
                
                
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                
            
                session(['cart' => $oldCart,]);
            
                if(!$oldCart->items){
                   
                    return redirect()->route('menu');
                
                }
              
                return redirect()->back();
//                }else{
//
//
//                Session::put('paid', 0);
//                Session::save();
//
//                Session::put('change',0);
//                Session::save();
//                $totalPrice=0;
//                return redirect('epoz')->with('totalPrice', $totalPrice);
            
            }
        
            // return redirect('epoz');
        
        
        }
    
    
    
    
    }