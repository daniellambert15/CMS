<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery_Address extends Model
{
    protected $table = 'delivery_addresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['customer_id', 'addressLine1',
        'addressLine2', 'town', 'county', 'postcode', 'firstName', 'surname'];

    // setup relationships
    public function customer(){
        return $this->hasOne('App\Model\Customer');
    }
}
