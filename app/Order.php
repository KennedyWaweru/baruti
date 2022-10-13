<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    public function fireworks(){
        return $this->belongsToMany(Firework::class)->withPivot('quantity');
    }

    public function packages(){
        return $this->belongsToMany(Package::class)->withPivot('quantity');
    }
}
