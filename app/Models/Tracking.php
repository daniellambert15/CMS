<?php

namespace App\Models;

use App\Models\Page;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    public function trackingClicks()
    {
    	return $this->hasMany('App\Models\trackingClick', "tracking_id");
    }

    public function leads()
    {
    	return $this->hasMany('App\Models\Lead', 'trackingId');
    }

    public function pageIdToName($id, $type)
    {
        if($type == 1)
        {
            return Page::find($id)->url;
        }elseif ($type == 2){
            return 'Shop-> '.Product::find($id)->name;
        }
    }
}
