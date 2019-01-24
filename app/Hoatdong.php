<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hoatdong extends Model
{

    protected $fillable = [
        'id', 'title', 'created_at', 'updated_at', 'slug', 'content', 'linhvuc_id', 'noibat', 'image_id'
    ];


    protected $hidden = [
        //
    ];

    public function linhvuc()
    {
        return $this->belongsTo(Linhvuc::class, 'linhvuc_id', 'id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }

}
