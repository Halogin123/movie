<?php

namespace MovieChill\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'type',
        'current_price',
        'capital_price',
        'total_money_company',
        'listed_volume',
        'working_capital',
        'remaining_balance',
        'actual_value',
    ];
}
