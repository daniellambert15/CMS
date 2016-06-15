<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['invoice_id', 'payment_id'];

    public function invoice(){
        return $this->hasOne('App\Model\Invoice');
    }
}
