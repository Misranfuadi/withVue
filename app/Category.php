<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name','iconImage'
    ];

    protected $casts = [
    'created_at' => 'datetime:d-F-Y',
    ];

}
