<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
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
    protected $fillable = ['name', 'description', 'parent_id', 'live', 'hidden', 'sitemap'];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    public function parentName()
    {
        if($this->parent_id > 0){
            $category = $this->find($this->parent_id);
            if($category){
                return $category->name;
            }else{return 'Unused Category';}
        }else{return 'top category';}
    }
}
