<?php

namespace Ducnm\Infrastructure\Persistance\Mysql;

use Ducnm\app\Models\Stock;
use Ducnm\Domain\Model\StockInterface;

class MysqlStockRepository extends AbstractRepository implements StockInterface
{
    protected $modelName = Stock::class;
}
