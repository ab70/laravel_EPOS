<?php
    
    namespace App\Http\Controllers\User;
    
    use App\Booking;
    use App\FoodItem;
    use App\Menu;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\DB;
    
    class MenuController extends Controller
    {
        public function showHeader()
        {
            $menus = Menu::all() ;
            //dd($menus);
    
            return view('user.newFood.index',compact('menus'));
        }
        
        public function showMenu()
        {
            $menus = Menu::all() ;
            //dd($menus);
            $name =  Menu::all() ;
            return view('user.home',compact('menus','name'));
        }
    
    
        public function showItemMenu($id)
        {
            
          
            $menus = Menu::all() ;
            //$users = DB::table('users')->where('votes', 100)->get();
            
            $items = DB::table('food_items')->where('menu_id', $id)->get();
            //dd($items);
            
            // $items = FoodItem::findOrFail($menu_id) ;
            return view('user.menu',compact('items','menus'));
        }
    
        public function BookingOrder(Request $request)
        {
            $input = $request->all();
            //dd($input);
            Booking::create($input);
            
            return redirect()->back();
    
        }
    
        public function deleteBooking($id)
        {
    
            $data = Booking::findOrFail($id);
            $data->delete();
    
            return redirect('admin/booking/details');
        }
    }


