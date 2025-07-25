<?php

namespace Ducnm\Infrastructure\Persistance\MysqlV2;

use Ducnm\app\Models\MonthlyPayment;
use Ducnm\Domain\ModelV2\MonthlyPaymentInterface;

class MonthlyPaymentRepository extends AbstractRepository implements MonthlyPaymentInterface
{

    public function getModel()
    {
        return MonthlyPayment::class;
    }
}
