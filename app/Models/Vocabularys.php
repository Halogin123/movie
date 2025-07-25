<?php

namespace Ducnm\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vocabularys extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'english',
        'vietnam',
    ];
}
