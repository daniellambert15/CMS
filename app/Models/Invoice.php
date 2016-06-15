<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cart_id', 'customer_id', 'status_id', 'location'];


    public function customer(){
        return $this->hasOne('App\Models\Customer');
    }

    public function cart(){
        return $this->hasOne('App\Models\Cart');
    }

    public function status(){
        return $this->hasOne('App\Models\Status');
    }

    public function payments(){
        return $this->hasOne('App\Models\Payment');
    }

}
