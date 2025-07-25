<?php

namespace MovieChill\app\Models;

class User extends \App\Models\User
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id'
    ];
}
