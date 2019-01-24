<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'id', 'title', 'created_at', 'updated_at', 'slug', 'introduce'
    ];


    protected $hidden = [
        //
    ];

    public function category()
    {
        return $this->hasMany(Category::class, 'room_id', 'id');
    }

    public function images()
    {
        return $this->belongsToMany('App\Image');
    }

}
