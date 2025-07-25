<?php

namespace Ducnm\Infrastructure\Persistance\MysqlV2;

use Ducnm\app\Models\MonthlyHistories;
use Ducnm\Domain\ModelV2\MonthlyHistoriesInterface;

class MonthlyHistoriesRepository extends AbstractRepository implements MonthlyHistoriesInterface
{

    public function getModel()
    {
        return MonthlyHistories::class;
    }
}
