<?php

namespace Ducnm\Infrastructure\Persistance\Mysql;

use Ducnm\app\Models\Logip;
use Ducnm\Domain\Model\LogIp\LogIpInterface;

class MysqlLogIpRepository extends AbstractRepository implements LogIpInterface
{
    protected $modelName = Logip::class;
}
