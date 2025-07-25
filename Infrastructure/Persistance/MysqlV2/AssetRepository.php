<?php

namespace MovieChill\Infrastructure\Persistance\MysqlV2;

use MovieChill\app\Models\Asset;
use MovieChill\Domain\ModelV2\AssetInterface;

class AssetRepository extends AbstractRepository implements AssetInterface
{

    public function getModel()
    {
        return Asset::class;
    }
}
