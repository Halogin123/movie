<?php

namespace MovieChill\Infrastructure\Persistance\Api;

use MovieChill\Infrastructure\Helpers\ApiHelpers;

class ApiCrawStockRepository
{
    public function crawInfoByCafeF($stockCode)
    {
        $url = 'https://s.cafef.vn/Ajax/PageNew/FinanceData/fi.ashx?symbol=' . $stockCode;
        $response = ApiHelpers::curlCafeF($url);

        return $response;
    }

    public function crawInfoByDnse($stockCode)
    {
        $url = 'https://services.entrade.com.vn/senses-api/v3/news/_query';
        $data = [
            "symbols" => [
                $stockCode
            ],
            "limit" => 1
        ];

        $response = ApiHelpers::curlDnse($url, 'POST', [], $data);

        return $response['news'][0]['statistics'];
    }

}
