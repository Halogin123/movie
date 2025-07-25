<?php

namespace Ducnm\app\Models;

use Ducnm\Domain\Enum\TransactionTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'to_account_id',
        'transaction_type',
        'amount',
        'description',
        'executed_at',
        'user_id',
    ];

    protected $casts = [
        'transaction_type' => TransactionTypeEnum::class,
    ];
}
