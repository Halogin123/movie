<?php

namespace MovieChill\Infrastructure\Persistance\MysqlV2;

use MovieChill\app\Models\Transactions;
use MovieChill\Domain\ModelV2\TransactionsInterface;

class TransactionsRepository extends AbstractRepository implements TransactionsInterface
{

    public function getModel()
    {
        return Transactions::class;
    }

    public function getAllTransactions($params)
    {
        $query = Transactions::query();

        if (!empty($params['startDate']) && !empty($params['endDate'])) {
            $query->whereBetween('executed_at', [$params['startDate'], $params['endDate']]);
        }

        $query->where('user_id', $params['user_id']);

        if (!empty($params['paginate'])) {
            return $query->orderBy('executed_at', 'desc')->paginate();

        } else {
            return $query->orderBy('executed_at', 'desc')->get();
        }
    }
}
