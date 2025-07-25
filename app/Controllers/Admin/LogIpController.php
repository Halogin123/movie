<?php

namespace Ducnm\app\Controllers\Admin;

use Ducnm\Application\LogIp\LogIpService;

class LogIpController extends BaseController
{
    protected $routeKey = 'logip';
    protected $resourceName = 'logip';

    public function __construct(
        LogIpService $logIpService
    ) {
        $this->service = $logIpService;
    }
}
