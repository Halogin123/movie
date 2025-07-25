<?php

namespace MovieChill\Infrastructure\Persistance\MysqlV2;

use MovieChill\app\Models\MonthlyHistories;
use MovieChill\Domain\ModelV2\MonthlyHistoriesInterface;

class MonthlyHistoriesRepository extends AbstractRepository implements MonthlyHistoriesInterface
{

    public function getModel()
    {
        return MonthlyHistories::class;
    }
}
