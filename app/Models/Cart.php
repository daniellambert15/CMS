<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cart_id', 'customer_id', 'tracking_id', 'delivery_id', 'invoice_id', 'processed'];

    // now we create our connections

    public function products(){
        return $this->hasMany('App\Models\Cart_Product', 'cart_id', 'id');
    }

    public function delivery(){
        return $this->hasOne('App\Models\Delivery', 'id', 'delivery_id');
    }

    public function invoice(){
        return $this->hasOne('App\Models\Invoice');
    }
}
