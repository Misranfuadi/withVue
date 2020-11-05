<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = ['tagName'];

    protected $casts = [
    'created_at' => 'datetime:d-F-Y',
    ];
}
