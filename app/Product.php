<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    //
    public $timestamps = false;

    use Sluggable;

    /**
 * Get the route key for the model.
 *
 * @return string
 *//*
    public function getRouteKeyName()
    {
    	return 'slug';
    }*/
     /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
