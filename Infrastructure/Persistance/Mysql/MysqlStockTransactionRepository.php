<?php

namespace Ducnm\Infrastructure\Persistance\Mysql;

use Ducnm\app\Models\StockTransaction;
use Ducnm\Domain\Model\StockTransactionInterface;

class MysqlStockTransactionRepository extends AbstractRepository implements StockTransactionInterface
{
    protected $modelName = StockTransaction::class;
}
