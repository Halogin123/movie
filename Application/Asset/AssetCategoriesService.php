<?php

namespace Ducnm\Application\Asset;

use Ducnm\Application\BaseService;
use Ducnm\Domain\Model\AssetCategoriesInterface;
use Ducnm\Infrastructure\Persistance\Mysql\AssetCategoriesRepository;

class AssetCategoriesService extends BaseService
{
    public function __construct(
//        AssetCategoriesInterface $assetCategoriesInterface,
        AssetCategoriesRepository $assetCategoriesInterface
    ){
        $this->repository = $assetCategoriesInterface;
    }
}
