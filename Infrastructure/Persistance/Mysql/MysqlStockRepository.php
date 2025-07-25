<?php

namespace MovieChill\Infrastructure\Persistance\Mysql;

use MovieChill\app\Models\Stock;
use MovieChill\Domain\Model\StockInterface;

class MysqlStockRepository extends AbstractRepository implements StockInterface
{
    protected $modelName = Stock::class;
}
