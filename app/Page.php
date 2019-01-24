<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $fillable = [
        'id', 'title', 'created_at', 'updated_at', 'slug', 'content', 'kichhoat'
    ];


    protected $hidden = [
        //
    ];

}
