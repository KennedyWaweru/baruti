<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Gloudemans\Shoppingcart\Contracts\Buyable;

class Firework extends Model implements Buyable
{
    //
    use Sluggable;
    protected $fillable = ['name','slug','effect_colors','images','price'];
    public function category(){
        return $this->belongsTo(Category::class);
    }

    /**
 * Get the route key for the model.
 *
 * @return string
 */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setColorAttribute($value){
        $this->attributes['effect_colors'] = json_encode($value);
    }
    public function order(){
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function packages(){
        return $this->belongsToMany(Package::class);
    }
    /*public function get_category_attribute($value){
        $this->attributes['effect_colors'] = json_decode($value);
    }

    public function set_images_attribute($value){
        $this->attributes['images'] = json_encode($value);
    }

    public function get_images_attribute($value){
        $this->attributes['images'] = json_decode($value);
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

    /**
     * Get the identifier of the Buyable item.
     *
     * @return int|string
     */
    public function getBuyableIdentifier($options = null){
        //return 'id';
        return $this->id;
    }

    /**
     * Get the description or title of the Buyable item.
     *
     * @return string
     */
    public function getBuyableDescription($options = null){
       // return 'name';
        return $this->name;
    }

    /**
     * Get the price of the Buyable item.
     *
     * @return float
     */
    public function getBuyablePrice($options = null){
        //return 'price';
        return $this->price;
    }

}
