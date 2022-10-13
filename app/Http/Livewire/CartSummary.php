<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;


class CartSummary extends Component
{
    public $cart_content, $cart_total;
    protected $listeners = ['cart-updated'=>'mount'];
    public function mount(){
        $this->cart_content = Cart::content();
        $this->cart_total = intval(str_replace(',','',Cart::subtotal(0,'',null)));
    }

    public function render()
    {
        return view('livewire.cart-summary');
    }
}
