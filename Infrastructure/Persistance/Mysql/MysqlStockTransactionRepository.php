<?php

namespace MovieChill\Infrastructure\Persistance\Mysql;

use MovieChill\app\Models\StockTransaction;
use MovieChill\Domain\Model\StockTransactionInterface;

class MysqlStockTransactionRepository extends AbstractRepository implements StockTransactionInterface
{
    protected $modelName = StockTransaction::class;
}
