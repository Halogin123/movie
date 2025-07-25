<?php

namespace Ducnm\Domain\Enum;

enum TransactionTypeEnum: string
{
    case TRANSFER = 'transfer';
    case DEPOSIT = 'deposit';
    case WITHDRAW = 'withdraw';
    case RECEIVE = 'receive';

    public function label(): string
    {
        return match($this) {
            self::TRANSFER => 'Chuyển tiền',
            self::DEPOSIT => 'Gửi tiền',
            self::WITHDRAW => 'Rút tiền',
            self::RECEIVE => 'Nhận tiền',
        };
    }
}
