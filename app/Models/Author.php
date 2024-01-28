<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $guarded = [];

    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }
    public function image()
    {
        return $this->belongsTo('App\Models\Image');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /*
     * Image Accessor
     */
    public function getImageUrlAttribute($value)
    {
        return asset('/').'assets/img/'.$this->image->file;
    }
    public function getDefaultImgAttribute($value)
    {
        return asset('/').'assets/img/'.'user-placeholder.png';
    }
}
