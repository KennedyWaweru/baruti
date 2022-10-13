<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Firework;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['name'];
    public function firework(){
        return $this->hasMany(Firework::class);
    }

    public function getRouteKeyName(){
        return 'slug';
    }

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
