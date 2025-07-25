<?php

namespace MovieChill\app\Providers;

use MovieChill\Domain\Model\AssetCategoriesInterface;
use MovieChill\Domain\Model\StockInterface;
use MovieChill\Domain\Model\StockTransactionInterface;
use MovieChill\Domain\ModelV2\AssetInterface;
use MovieChill\Domain\ModelV2\DebtInterface;
use MovieChill\Domain\ModelV2\MonthlyPaymentInterface;
use MovieChill\Domain\ModelV2\TransactionsInterface;
use MovieChill\Infrastructure\Persistance\Mysql\AssetCategoriesRepository;
use MovieChill\Infrastructure\Persistance\Mysql\MysqlStockRepository;
use MovieChill\Infrastructure\Persistance\Mysql\MysqlStockTransactionRepository;
use MovieChill\Infrastructure\Persistance\MysqlV2\AssetRepository;
use MovieChill\Infrastructure\Persistance\MysqlV2\DebtRepository;
use MovieChill\Infrastructure\Persistance\MysqlV2\MonthlyPaymentRepository;
use MovieChill\Infrastructure\Persistance\MysqlV2\TransactionsRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StockInterface::class, MysqlStockRepository::class);
        $this->app->bind(StockTransactionInterface::class, MysqlStockTransactionRepository::class);
        $this->app->bind(AssetCategoriesInterface::class, AssetCategoriesRepository::class);
        $this->app->bind(AssetInterface::class, AssetRepository::class);
        $this->app->bind(DebtInterface::class, DebtRepository::class);
        $this->app->bind(MonthlyPaymentInterface::class, MonthlyPaymentRepository::class);
        $this->app->bind(TransactionsInterface::class, TransactionsRepository::class);
    }
}
