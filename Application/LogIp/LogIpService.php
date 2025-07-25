<?php

namespace Ducnm\Application\LogIp;

use Ducnm\Application\BaseService;
use Ducnm\Infrastructure\Persistance\Mysql\MysqlLogIpRepository;

class LogIpService extends BaseService
{
    public function __construct(
        MysqlLogIpRepository $LogIpInterface
    ) {
        $this->repository = $LogIpInterface;
    }
}
