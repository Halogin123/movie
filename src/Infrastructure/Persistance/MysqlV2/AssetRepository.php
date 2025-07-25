<?php

namespace Ducnm\Infrastructure\Persistance\MysqlV2;

use Ducnm\app\Models\Asset;
use Ducnm\Domain\ModelV2\AssetInterface;

class AssetRepository extends AbstractRepository implements AssetInterface
{

    public function getModel()
    {
        return Asset::class;
    }
}
