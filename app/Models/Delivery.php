<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['addressLine1', 'addressLine2', 'town', 'county', 'postcode', 'firstName', 'surname'];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'delivery';

    public function carts()
    {
        return $this->belongsToMany('App\Models\Cart');
    }
}
