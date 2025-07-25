<?php

namespace Ducnm\Infrastructure\Persistance\Mysql;

use Ducnm\app\Models\AssetCategories;
use Ducnm\Domain\Model\AssetCategoriesInterface;

class AssetCategoriesRepository extends AbstractRepository implements AssetCategoriesInterface
{
    protected $modelName = AssetCategories::class;
}
