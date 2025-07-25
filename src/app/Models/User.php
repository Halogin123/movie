<?php

namespace Ducnm\app\Models;

class User extends \App\Models\User
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id'
    ];
}
