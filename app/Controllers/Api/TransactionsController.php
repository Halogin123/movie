<?php

namespace MovieChill\app\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use MovieChill\Application\Transactions\TransactionsService;
use MovieChill\Domain\Enum\TransactionTypeEnum;
use MovieChill\Infrastructure\Helpers\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TransactionsController extends Controller
{
    public function __construct(
        private TransactionsService $transactionsService
    ) {
    }

    public function hookSepay(Request $request)
    {
        Log::info('sepay-payment', $request->all());

        try {
            $param['amount'] = $request->get('transferAmount');
            $param['description'] = $request->get('content');

            $transferType = $request->get('transferType');
            switch ($transferType) {
                case 'in':
                    $param['transaction_type'] = TransactionTypeEnum::RECEIVE;
                    break;

                case 'out':
                    $param['transaction_type'] = TransactionTypeEnum::WITHDRAW;
                    break;
            }

            $param['to_account_id'] = $request->get('accountNumber');
            $param['executed_at'] = $request->get('transactionDate');
            $this->transactionsService->createTransaction($param);

            return ResponseHelper::sendResponse(Response::HTTP_OK, "Hứng giao dịch thành công");
        } catch(\Exception $e) {
            Log::info($e->getMessage(), (array)$e);
            return ResponseHelper::sendResponse(Response::HTTP_INTERNAL_SERVER_ERROR, "Hứng giao dịch thất bại");
        }
    }

    public function hookTransactionApp(Request $request)
    {
        Log::info('sms-transaction', $request->all());
        try {
            $description = $request->get('description');
            $userId = $request->get('userId');

            $dataFormatTransaction = $this->parseTpBankSms($description);

            if ($dataFormatTransaction['bank'] === 'TPBank') {
                $dataFormatTransaction['to_account_id'] = $request->get('address');
                $dataFormatTransaction['user_id'] = $userId;
                $this->transactionsService->createTransaction($dataFormatTransaction);
            }

            return ResponseHelper::sendResponse(Response::HTTP_OK, "Hứng giao dịch thành công");
        } catch(\Exception $e) {
            Log::info($e->getMessage(), (array)$e);
            return ResponseHelper::sendResponse(Response::HTTP_INTERNAL_SERVER_ERROR, "Hứng giao dịch thất bại");
        }
    }

    function parseTpBankSms($sms): array
    {
        preg_match('/\((.*?)\):/', $sms, $typeMatch);
        preg_match('/\):\s*(\d{2}\/\d{2}\/\d{2});(\d{2}:\d{2})/', $sms, $match);

        // Chuyển đổi ngày giờ nếu tìm thấy
        $executedAt = null;
        if (!empty($match)) {
            $rawDate = $match[1]; // 12/05/25
            $rawTime = $match[2]; // 13:18

            $date = Carbon::createFromFormat('d/m/y', $rawDate)->format('d-m-Y');
            $executedAt = Carbon::createFromFormat('d-m-Y H:i', ($date . ' ' . $rawTime))->format('Y-m-d H:i:s');

        }

        preg_match('/PS:\s*([+-]?[\d\.]+)VND/', $sms, $amountMatch);

        if (!empty($amountMatch[1])) {
            // Loại bỏ dấu + hoặc -
            $amountString = ltrim($amountMatch[1], '+-');
            // Loại bỏ dấu chấm (.)
            $amountClean = str_replace('.', '', $amountString);
            // Chuyển thành số nguyên
            $amount = (int) $amountClean;

            if ($amountMatch[1][0] === '-') {
                $transactionType = TransactionTypeEnum::WITHDRAW;
            } else {
                $transactionType = TransactionTypeEnum::RECEIVE;
            }
        }

//        $amount = isset($amountMatch[1]) ? (int) abs(str_replace('.', '', $amountMatch[1])) : null;

        preg_match('/ND:\s*(.*?)\s+SO GD:/', $sms, $descriptionMatch);
        preg_match('/SO GD:([A-Z0-9]+)/', $sms, $codeMatch);

        return [
            'bank' => $typeMatch[1] ?? '',
            'executed_at' => $executedAt,
            'amount' => $amount,
            'description' => $descriptionMatch[1] ?? null,
            'code' => $codeMatch[1] ?? null,
            'transaction_type' => $transactionType
        ];
    }

    public function listTransaction(Request $request): JsonResponse
    {
        $startDate = $request->get('startDate') ?: Carbon::now()->startOfMonth();
        $endDate = $request->get('endDate') ?: Carbon::now()->endOfMonth();
        $userId = $request->get('userId');

        try {
            $data = $this->transactionsService->getAllTransactionsByMonthAndYear($startDate, $endDate, $userId);

            $dataCustom = [];

            foreach($data as $key => $item) {
                $dataCustom[$key] = $item;
                $dataCustom[$key]['amount'] = number_format($item['amount']);
                $dataCustom[$key]['type'] = $item->transaction_type->label();
            }

            return ResponseHelper::sendResponse(Response::HTTP_OK, "Lấy thành công", $dataCustom);
        } catch(\Exception $e) {
            return ResponseHelper::sendResponse(Response::HTTP_INTERNAL_SERVER_ERROR, "Lấy dữ liệu thất bại");
        }
    }
}
