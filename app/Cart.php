<?php
    
    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Session;

    class Cart extends Model
    {
        
        protected $fillable = [
            'item', 'qty', 'price',
        ];
        
        public $items = null;
        public $totalQty= 0;
        public $totalPrice= 0;
        
        public function __construct($oldCart)
        {
            if ($oldCart){
                $this->items = $oldCart->items;
                $this->totalQty = $oldCart->totalQty;
                $this->totalPrice = $oldCart->totalPrice;
                
            }
            
        }
        
        
        public function add($item,$id)
        {
            $storedItem = ['qty'=>0 ,'price'=>$item->price ,'item'=>$item ];
            
            if ($this->items){
                
                if (array_key_exists($id,$this->items)){
                    $storedItem =$this->items[$id];
                    var_dump($storedItem);
                    
                }
            }
            
                $storedItem['qty']++;
                $storedItem['price']=$item->price * $storedItem['qty'];
                
                
                $this->items[$id] = $storedItem;
                $this->totalQty++ ;
                $this->totalPrice +=$item->price;
                
        }
        
        public function getCart()
        {
            if ( ! Session::has('cart')){
                return view ('shop.shopping-cart');
            }
            
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            return view ('shop.shopping-cart',['products'=>$cart->items,'totalPrice'=>$cart->totalPrice]);
            
            
        }
        
        public function reduceByOne($id) {
            $this->items[$id]['qty']--;
            $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
            $this->totalQty--;
            $this->totalPrice -= $this->items[$id]['item']['price'];
            if ($this->items[$id]['qty'] <= 0) {
                unset($this->items[$id]);
            }
        }
        
        
        
    }
