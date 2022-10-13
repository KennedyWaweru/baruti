<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Gloudemans\Shoppingcart\Cart;

//use App\Http\Livewire\ShoppingCart;

class ShoppingCart extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    //public $count = ShoppingCart::count;
    public $total;
    public $cart_count;
    public function __construct(Cart $cart)
    {
        //
        $this->total = $cart->subtotal;
        $this->cart_count = $cart->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.shopping-cart');
    }
}
