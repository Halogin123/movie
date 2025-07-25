<?php

namespace Ducnm\app\Providers;

use Ducnm\Domain\Model\AssetCategoriesInterface;
use Ducnm\Domain\Model\StockInterface;
use Ducnm\Domain\Model\StockTransactionInterface;
use Ducnm\Domain\ModelV2\AssetInterface;
use Ducnm\Domain\ModelV2\DebtInterface;
use Ducnm\Domain\ModelV2\MonthlyPaymentInterface;
use Ducnm\Domain\ModelV2\TransactionsInterface;
use Ducnm\Infrastructure\Persistance\Mysql\AssetCategoriesRepository;
use Ducnm\Infrastructure\Persistance\Mysql\MysqlStockRepository;
use Ducnm\Infrastructure\Persistance\Mysql\MysqlStockTransactionRepository;
use Ducnm\Infrastructure\Persistance\MysqlV2\AssetRepository;
use Ducnm\Infrastructure\Persistance\MysqlV2\DebtRepository;
use Ducnm\Infrastructure\Persistance\MysqlV2\MonthlyPaymentRepository;
use Ducnm\Infrastructure\Persistance\MysqlV2\TransactionsRepository;
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
