<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Order extends Component
{

    public $buyNow = False;
    public $itemSlug;
    
    public function render()
    {
        return view('livewire.order');
    }
}
