<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Firework;
use App\Package;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShoppingCart extends Component
{
    public $count;
    public array $options = [];
    public $cart_content;
    public array $quantity = [];
    public $cart_count;
    public $products_in_cart;
    protected $listeners = ['cart-updated'=>'mount','removeFromCart'];

    public function mount(){
        $this->cart_content = Cart::content();
        //dd($this->cart_content);
        foreach($this->cart_content as $cartItem){
            
            //$this->products_in_cart[$cartItem->id] = Firework::findOrFail($cartItem->id);
            //$this->quantity[$cartItem->id] = $cartItem->qty;
            if($cartItem->options['type'] == 'product'){
                $this->products_in_cart[$cartItem->id] = Firework::findOrFail($cartItem->id);
                //$this->quantity[$cartItem->id] = $cartItem->qty;
            }
            else{
                $this->products_in_cart[$cartItem->id] = Package::where('slug',$cartItem->id)->first();
                //$this->quantity[$cartItem->id] = $cartItem->qty;
            }
            $this->options[$cartItem->id] = $cartItem->options;
            $this->quantity[$cartItem->id] = $cartItem->qty;
        }
        $this->count = Cart::content()->count();
    }
    
    public function render()
    {
        return view('livewire.shopping-cart');
    }
    
    public function increment($product_id, $in_stock){
        if($this->quantity[$product_id] < $in_stock){
            $this->quantity[$product_id] ++ ;
            $my_item = $this->cart_content->where('id',$product_id)->first();
            # update the quantity pass the update method the rowId and the new quantity
            Cart::update($my_item['rowId'],$this->quantity[$product_id]);
            # emit event to cart-summary table page
            $this->emitTo('cart-summary','cart-updated');
        }
    }

    public function decrement($product_id){
        if($this->quantity[$product_id] > 1){
            $this->quantity[$product_id] -- ;
            $my_item = $this->cart_content->where('id',$product_id)->first();
            # update the quantity pass the update method the rowId and the new quantity
            Cart::update($my_item['rowId'],$this->quantity[$product_id]);
            # dispatch event to cart-summary table page
            $this->emitTo('cart-summary','cart-updated');
        }else{
            $this->quantity[$product_id] = 1;
        }
        
    }
    public function removeFromCart($product_id){
        $my_item = $this->cart_content->where('id',$product_id)->first();

        Cart::remove($my_item['rowId']);

        unset($this->products_in_cart[$product_id]);
        unset($this->quantity[$product_id]);
        unset($this->cart_content[$product_id]);
        $this->dispatchBrowserEvent('removedFromCartSuccess', $my_item);
    } 
}
