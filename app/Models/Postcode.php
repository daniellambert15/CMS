<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postcode extends Model
{
    public function office()
    {
        return $this->belongsToMany('App\Models\Office');
    }
}
