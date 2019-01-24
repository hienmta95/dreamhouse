<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linhvuc extends Model
{
    protected $fillable = [
        'id', 'title', 'created_at', 'updated_at', 'slug', 'introduce'
    ];


    protected $hidden = [
        //
    ];

    public function hoatdong()
    {
        return $this->hasMany(Hoatdong::class, 'linhvuc_id', 'id');
    }

}
