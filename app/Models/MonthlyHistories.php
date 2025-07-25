<?php

namespace MovieChill\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyHistories extends Model
{
    use HasFactory;

    protected $fillable = [
        'month',
        'year',
        'total_income',
        'total_expense',
        'balance_start',
        'balance_end',
        'user_id',
    ];
}
