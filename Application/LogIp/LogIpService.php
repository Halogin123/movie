<?php

namespace MovieChill\Application\LogIp;

use MovieChill\Application\BaseService;
use MovieChill\Infrastructure\Persistance\Mysql\MysqlLogIpRepository;

class LogIpService extends BaseService
{
    public function __construct(
        MysqlLogIpRepository $LogIpInterface
    ) {
        $this->repository = $LogIpInterface;
    }
}
