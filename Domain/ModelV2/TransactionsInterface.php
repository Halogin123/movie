<?php

namespace Ducnm\Domain\ModelV2;

interface TransactionsInterface extends BaseInterface
{
    public function getAllTransactions($params);
}
