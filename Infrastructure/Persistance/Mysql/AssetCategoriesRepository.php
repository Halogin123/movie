<?php

namespace MovieChill\Infrastructure\Persistance\Mysql;

use MovieChill\app\Models\AssetCategories;
use MovieChill\Domain\Model\AssetCategoriesInterface;

class AssetCategoriesRepository extends AbstractRepository implements AssetCategoriesInterface
{
    protected $modelName = AssetCategories::class;
}
