<?php

namespace MovieChill\Application\Stock;

use MovieChill\Application\BaseService;
use MovieChill\Infrastructure\Persistance\Api\ApiCrawStockRepository;
use MovieChill\Infrastructure\Persistance\Mysql\MysqlStockRepository;

class StockService extends BaseService
{
    public function __construct(
        MysqlStockRepository $stockInterface,
        ApiCrawStockRepository $apiCrawStockRepository
    ) {
        $this->repository = $stockInterface;
        $this->apiCrawStockRepository = $apiCrawStockRepository;
    }

    public function getDataDashboard(): array
    {
        $data['total'] = $this->repository->sumBy([], 'capital_price');
        $data['total-stock'] = $this->repository->sumBy(['type' => 1], 'capital_price');
        $data['total-fund-certificate'] = $this->repository->sumBy(['type' => 2], 'capital_price');
        $data['profit-and-loss'] = $this->calculateProfitAndLoss();
//        dd($data);
        return $data;
    }

    public function formatInfoCraw($stockCode): void
    {
//        $responseCafeF = $this->apiCrawStockRepository->crawInfoByCafeF($stockCode);
        $responseDnses = $this->apiCrawStockRepository->crawInfoByDnse($stockCode);

        foreach ($responseDnses as $key => $responseDnse) {
            if ($responseDnse['symbol'] == $stockCode) {
                $currentPrice = $responseDnses[$key]['stockPriceAtPublish'] ?? 0;
            }
        }

        $stockResponse = $this->repository->findOneBy(['code' => $stockCode]);

        $stock['current_price'] = $currentPrice ?? 0;

        $this->repository->update($stockResponse, $stock);
    }

    public function calculateProfitAndLoss()
    {
        $stocks = $this->repository->findBy([], true);
        $actual = 0;
        $current = 0;

        foreach ($stocks as $key => $stock) {
            $countActual = $stock->actual_value * $stock->remaining_balance;
            $actual += $countActual;

            $countCurrent = $stock->current_price * $stock->remaining_balance;
            $current += $countCurrent;
        }

        return ($current - $actual) * 1000;
    }
}
