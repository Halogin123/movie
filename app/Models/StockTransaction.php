<?php

namespace MovieChill\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'type',
        'transaction_price',
        'transaction_money',
        'transaction_price_at_time',
        'transaction_quantity',
        'remaining_balance',
        'transaction_time',
        'note',
    ];
}
