<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart_Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cart_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cart_id', 'product_id', 'price', 'delivery', 'quantity'];

    // now we create the connection

    public function cart()
    {
        return $this->hasOne('App\Models\Cart');
    }

    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }

}
