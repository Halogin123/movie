<?php

namespace Ducnm\Application\Stock;

use Carbon\Carbon;
use Ducnm\Application\BaseService;
use Ducnm\Infrastructure\Persistance\Mysql\MysqlStockRepository;
use Ducnm\Infrastructure\Persistance\Mysql\MysqlStockTransactionRepository;
use Ducnm\Infrastructure\Trait\Formula;

class StockTransactionService extends BaseService
{
    use Formula;

    protected MysqlStockRepository $mysqlStockRepository;
    protected MysqlStockTransactionRepository $repository;

    public function __construct(
        MysqlStockTransactionRepository $stockTransactionInterface,
        MysqlStockRepository $mysqlStockRepository
    ) {
        $this->repository = $stockTransactionInterface;
        $this->mysqlStockRepository = $mysqlStockRepository;
    }

    public function transaction($request): void
    {
        $stockCode = $request['code'];

        $stockResponse = $this->mysqlStockRepository->findOneBy(['code' => $stockCode]);

        $this->recordStockTransaction($request, $stockCode, $stockResponse);

        $stockTransactions = $this->repository->findBy(['code' => $stockCode], true);

        if ($stockResponse['type'] == 1) {
            $this->recordStock($stockTransactions, $stockResponse);
        } else {
            $this->recordFundCertificates($stockTransactions, $stockResponse);
        }
    }

    public function deleteTransaction($id): void
    {
        $stockTransaction = $this->repository->findOne($id);

        $code = $stockTransaction['code'];

        $this->repository->delete($stockTransaction);

        $stockResponse = $this->mysqlStockRepository->findOneBy(['code' => $code]);
        $stockTransactions = $this->repository->findBy(['code' => $code], true);

        $this->recordStock($stockTransactions, $stockResponse);
    }

    private function recordStockTransaction($request, $stockCode, $stockResponse): void
    {
        $stockTransaction = [];

        $stockTransaction['code'] = $stockCode;
        $stockTransaction['type'] = $request['type'];
        $stockTransaction['transaction_price'] = $request['transaction_price'];
        $stockTransaction['transaction_money'] = $request['transaction_money'];
        $stockTransaction['transaction_price_at_time'] = $request['transaction_price_at_time'];
        $stockTransaction['transaction_quantity'] = $request['transaction_quantity'];
        $stockTransaction['remaining_balance'] = $stockResponse['remaining_balance'] ?: 0;
        $stockTransaction['transaction_time'] = $request['transaction_time'] ?? Carbon::now();
        $stockTransaction['note'] = $request['note'];

        $this->repository->save($stockTransaction);
    }

    private function recordStock($stockTransactions, $stockResponse): void
    {
        $stock = [];
        $countTransactionMoney = [];
        $countTransactionQuantity = [];

        foreach ($stockTransactions as $key => $stockTransaction) {
            //bán
            if ($stockTransaction['type'] === 1) {
                $countTransactionMoney[$key] = -$stockTransaction['transaction_money'];
                $countTransactionQuantity[$key] = -$stockTransaction['transaction_quantity'];
            }
            //mua
            if ($stockTransaction['type'] === 2) {
                $countTransactionMoney[$key] = $stockTransaction['transaction_money'];
                $countTransactionQuantity[$key] = $stockTransaction['transaction_quantity'];
            }
        }
        //tổng giá trị CP
        $sumTransactionMoney = $this->sum($countTransactionMoney);
        //tổng số lượng CP
        $sumTransactionQuantity = $this->sum($countTransactionQuantity);
        // giá trị thực
        $actualValue = $this->division($sumTransactionMoney, $sumTransactionQuantity);

        $stock['capital_price'] = $sumTransactionMoney;
        $stock['remaining_balance'] = $sumTransactionQuantity;
        $stock['actual_value'] = $this->division($actualValue, 1000);

        $this->mysqlStockRepository->update($stockResponse, $stock);
    }

    private function recordFundCertificates($stockTransactions, $stockResponse)
    {
        $stock = [];
        $countTransactionMoney = [];
        $countTransactionQuantity = [];

        foreach ($stockTransactions as $key => $stockTransaction) {
        //bán
            if ($stockTransaction['type'] === 1) {
                $countTransactionMoney[$key] = -($stockTransaction['transaction_price'] * $stockTransaction['transaction_quantity']);
                $countTransactionQuantity[$key] = -$stockTransaction['transaction_quantity'];
            }
            //mua
            if ($stockTransaction['type'] === 2) {
                $countTransactionMoney[$key] = $stockTransaction['transaction_price'] * $stockTransaction['transaction_quantity'];
                $countTransactionQuantity[$key] = $stockTransaction['transaction_quantity'];
            }
        }

        //tổng giá trị CP
        $sumTransactionMoney = $this->sum($countTransactionMoney);
        //tổng số lượng CP
        $sumTransactionQuantity = $this->sum($countTransactionQuantity);
        // giá trị thực
        $actualValue = $this->division($sumTransactionMoney, $sumTransactionQuantity);

        $stock['capital_price'] = $sumTransactionMoney;
        $stock['remaining_balance'] = $sumTransactionQuantity;
        $stock['actual_value'] = $this->division($actualValue, 1000);

        $this->mysqlStockRepository->update($stockResponse, $stock);
    }
}
