<?php

namespace Ducnm\app\Controllers\Admin;

use Ducnm\Application\Stock\StockService;
use Ducnm\Application\Stock\StockTransactionService;
use Illuminate\Http\Request;

class StockTransactionController extends BaseController
{
    protected $routeKey = 'stock_transaction';
    protected $resourceName = 'stock-transactions';

    public function __construct(
        StockTransactionService $stockTransactionService,
        StockService $stockService
    ) {
        $this->service = $stockTransactionService;
        $this->stockService = $stockService;
    }

    public function create()
    {
        $create = parent::create();

        $create['stocks'] = $this->stockService->getList([], true);

        return $create;
    }

    public function edit(string $id)
    {
        $edit = parent::edit($id);

        $edit['stocks'] = $this->stockService->getList([], true);

        return $edit;
    }

    public function store(Request $request)
    {
        $this->service->transaction($request->all());

        return $this->index($request);
    }

    public function destroy(string $id)
    {
        $this->service->deleteTransaction($id);

        return redirect()->route($this->resourceName. '.index');
    }
}
