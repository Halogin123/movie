<?php

namespace Ducnm\app\Controllers\Admin;

use Ducnm\Application\Stock\StockService;
use Illuminate\Http\Request;

class FundCertificatesController extends BaseController
{
    protected $routeKey = 'fund_certificate';
    protected $resourceName = 'fund-certificates';

    public function __construct(
        StockService $stockService
    ) {
        $this->service = $stockService;
    }

    public function index(Request $request, array $params = [])
    {
        $params['type'] = 2;
        return parent::index($request, $params);
    }

}
