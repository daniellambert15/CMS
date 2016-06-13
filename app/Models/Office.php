<?php

namespace App\Models;
// test
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    public function postcode()
    {
        return $this->belongsToMany('App\Models\Postcode');
    }
}
