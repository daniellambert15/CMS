<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Customer extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstName', 'surname', 'email', 'password', 'tracking_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function deliveryAddresses()
    {
        return $this->hasMany('App\Models\Delivery_Address');
    }

    public function leads(){
        return $this->hasMany('App\Models\Lead', 'customer_id', 'id');
    }

    public function trackings(){
        return $this->hasMany('App\Models\Tracking', 'trackingid', 'tracking_id');
    }

    public function invoices(){
        return $this->hasMany('App\Models\Invoice', 'customer_id', 'id');
    }

    public function carts(){
        return $this->hasMany('App\Models\Cart', 'customer_id', 'id')->where("processed", "N");
    }

    public function orders(){
        return $this->hasMany('App\Models\Cart', 'customer_id', 'id')->where("processed", "Y");
    }
}