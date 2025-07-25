<?php

namespace MovieChill\app\Controllers\Admin;

use MovieChill\Application\LogIp\LogIpService;

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
