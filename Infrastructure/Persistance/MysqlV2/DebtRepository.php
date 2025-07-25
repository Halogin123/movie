<?php

namespace MovieChill\Infrastructure\Persistance\MysqlV2;

use MovieChill\app\Models\Debt;
use MovieChill\Domain\ModelV2\DebtInterface;

class DebtRepository extends AbstractRepository implements DebtInterface
{

    public function getModel()
    {
       return Debt::class;
    }
}
