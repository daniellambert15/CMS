<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingClick extends Model
{
    public function Tracking()
    {
    	return $this->hasMany('App\Models\Tracking', 'trackingId');
    }
}
