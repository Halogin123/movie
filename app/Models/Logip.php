<?php

namespace MovieChill\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logip extends Model
{
    use HasFactory;

    protected $table = 'log_ip';

    protected $fillable = [
        'id',
        'ip',
    ];
}
