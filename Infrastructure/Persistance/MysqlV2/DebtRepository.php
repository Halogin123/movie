<?php

namespace Ducnm\Infrastructure\Persistance\MysqlV2;

use Ducnm\app\Models\Debt;
use Ducnm\Domain\ModelV2\DebtInterface;

class DebtRepository extends AbstractRepository implements DebtInterface
{

    public function getModel()
    {
       return Debt::class;
    }
}
