<?php

namespace MovieChill\Application\Asset;

use MovieChill\Application\BaseService;
use MovieChill\Domain\Model\AssetCategoriesInterface;
use MovieChill\Infrastructure\Persistance\Mysql\AssetCategoriesRepository;

class AssetCategoriesService extends BaseService
{
    public function __construct(
//        AssetCategoriesInterface $assetCategoriesInterface,
        AssetCategoriesRepository $assetCategoriesInterface
    ){
        $this->repository = $assetCategoriesInterface;
    }
}
