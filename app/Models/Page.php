<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = ['name','url','title','type','content','contactForm','metaDescription','live','hidden','page_id','blueBarTitle','affiliate_id','sitemap'];

	public function children()
	{
		return $this->hasMany('App\Models\Page', 'page_id')->where('live', '=', 'Y')->where('hidden', '=', 'N');

    }

    public function parentName()
    {
    	if($this->page_id > 0)
    	{
    		return $this->withTrashed($this->id)->first()->name;
    	}
    }


    public function images()
    {
        return $this->belongsToMany('App\Models\Image');
    }


    public function tracking()
    {
        return $this->hasMany('App\Models\Tracking', 'pageId')->where('type_id', 1)->groupBy('trackingId');
    }

    public function leads()
    {
        return $this->hasMany('App\Models\Lead', 'pageId');
    }
}
