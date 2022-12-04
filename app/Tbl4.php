<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl4 extends Model
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
    
   
    
}
