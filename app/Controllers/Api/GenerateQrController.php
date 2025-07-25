<?php

namespace Ducnm\app\Controllers\Api;

use App\Helpers\CallApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

;

class GenerateQrController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function mart()
    {
        return view('Profile.mart.index');
    }

    public function generateQrMart(Request $request)
    {
        $mb = [
            "accountNo" => '1235566797979',
            "accountName" => "Nguyễn Thị Chinh",
            "acqId" => 970422,
        ];

        $tp = [
            "accountNo" => '03019005301',
            "accountName" => "Nguyễn Thị Chinh",
            "acqId" => 970423,
        ];



        $form = [
            "amount" => intval(str_replace(',', '', $request->get('amount'))),
            "addInfo" => $request->get('addInfo')?: "Mua Hang ". Carbon::now()->format('d/m/Y H:i:s'),
        ];

        if ($request->get('bank') === 'tpbank') {
            $param = array_merge($tp, $form);
        } else if($request->get('bank') === 'mbbank') {
            $param = array_merge($mb, $form);
        } else {
            $param = array_merge($tp, $form);
        }

        $data = CallApi::callApiGenerate($param);

        return $data['data']['qrDataURL'];
    }

    public function generateQr(Request $request)
    {
        $param = [
            "accountNo" => '02414960901',
            "accountName" => "Nguyễn Minh Đức",
            "acqId" => 970423,
            "amount" => intval($request->get('amount')),
            "addInfo" => $request->get('addInfo'),
        ];

        $data = CallApi::callApiGenerate($param);

        return $data['data']['qrDataURL'];
    }
}
