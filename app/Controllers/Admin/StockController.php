<?php

namespace Ducnm\app\Controllers\Admin;

use Ducnm\Application\Stock\StockService;
use Illuminate\Http\Request;

class StockController extends BaseController
{
    protected $routeKey = 'stock';
    protected $resourceName = 'stocks';

    public function __construct(
        StockService $stockService
    ) {
        $this->service = $stockService;
    }

    public function dashboard()
    {
        $data = $this->service->getDataDashboard();
        $stocks = $this->service->getList([], true);

        return view('admin.pages.dashboard.dashboard-stock', compact('data', 'stocks'));
    }

    public function index(Request $request, array $params = [])
    {
        $params['type'] = 1;
        return parent::index($request, $params);
    }

    public function crowInfo($stockCode)
    {
        $this->service->formatInfoCraw($stockCode);
        return redirect()->route($this->resourceName. '.index');
    }
}
