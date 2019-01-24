<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'id', 'title', 'created_at', 'updated_at', 'slug', 'description', 'category_id', 'masanpham', 'baohanh', 'kichthuoc', 'price', 'status', 'chatlieu'
    ];


    protected $hidden = [
        //
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function images()
    {
        return $this->belongsToMany('App\Image');
    }

}
