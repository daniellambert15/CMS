<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    
    protected $dates = ['deleted_at'];



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'price', 'delivery', 'password', 'live', 'hidden', 'sitemap'];



    public function image()
    {
        return $this->belongsToMany('App\Models\Image');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }
}
