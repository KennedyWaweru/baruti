<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Firework;
use Gloudemans\Shoppingcart\Facades\Cart;

class RelatedProducts extends Component
{
    public $related_products;
    public $quantity;

    public function mount(){
        foreach($this->related_products as $related_product){
            $this->quantity[$related_product['id']] = 1;
        }
    }
    public function render()
    {
        return view('livewire.related-products');
    }

    public function addToCart($product_id){
        $product = Firework::findOrFail($product_id);
        $qty = (int)$this->quantity[$product_id] <= (int)$product->stock 
                    ? (int)$this->quantity[$product_id]
                    : (int)$product->stock;

        $cart_item = Cart::add([
           'id' => $product->id,
           'name' => $product->name,
           'price' => $product->price,
           'qty' => $qty,
           'options'=>['type'=>'product']
        ]);
        $this->emitTo('shopping-cart', 'cart-updated');
        //dd($this->quantity[$product_id]);
    }
}
