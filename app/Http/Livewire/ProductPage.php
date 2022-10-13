<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Firework;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductPage extends Component
{
    public $product_id;
    public $quantity, $max_stock;
    protected $listeners = ['addProductToCart'];
    public function render()
    {
        return view('livewire.product-page');
    }

    public function addProductToCart($product_id,$qty){
        $product = Firework::findOrFail($product_id);
        $qty = (int)$qty <= (int)$product->stock 
        ? (int)$qty 
        : $product->stock;

        $cartItem = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => (int)$qty,
            'price' => $product->price,
            'options'=>['type'=>'product']
        ])->associate('Firework');

        $this->emitTo('shopping-cart','cart-updated');
    }
    
}
