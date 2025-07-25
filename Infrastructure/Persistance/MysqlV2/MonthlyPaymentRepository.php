<?php

namespace MovieChill\Infrastructure\Persistance\MysqlV2;

use MovieChill\app\Models\MonthlyPayment;
use MovieChill\Domain\ModelV2\MonthlyPaymentInterface;

class MonthlyPaymentRepository extends AbstractRepository implements MonthlyPaymentInterface
{

    public function getModel()
    {
        return MonthlyPayment::class;
    }
}
