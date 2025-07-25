<?php

namespace Ducnm\app\Controllers\Admin;

use Ducnm\Application\Asset\AssetCategoriesService;

class AssetCategoriesController extends BaseController
{
    protected $routeKey = 'asset-categories';
    protected $resourceName = 'asset-categories';

    public function __construct(
        AssetCategoriesService $assetCategoriesService,
    ){
        $this->service = $assetCategoriesService;
    }
}
