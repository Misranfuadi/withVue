<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = [
        'roleName','permission'
    ];

    protected $casts = [
    'created_at' => 'datetime:d-F-Y',
    ];
}
