<?php

namespace MovieChill\Infrastructure\Persistance\Mysql;

use MovieChill\app\Models\Logip;
use MovieChill\Domain\Model\LogIp\LogIpInterface;

class MysqlLogIpRepository extends AbstractRepository implements LogIpInterface
{
    protected $modelName = Logip::class;
}
