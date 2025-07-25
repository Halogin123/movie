<?php

namespace Ducnm\app\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Ducnm\Application\MonthlyHistories\MonthlyHistoriesService;
use Ducnm\Application\Transactions\TransactionsService;
use Ducnm\Infrastructure\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class DashBoardController extends Controller
{
    public function __construct(
        private TransactionsService $transactionsService,
        private MonthlyHistoriesService $monthlyHistoriesService
    ) {
    }

    public function index(Request $request)
    {
        try {
            $monthlyHistories = $this->monthlyHistoriesService->getMonthlyHistoriesByDate(Carbon::now()->format('Y-m'), $request->get('user_id'));

            $receive = $monthlyHistories->total_income ?? 0;
            $withdraw = $monthlyHistories->total_expense ?? 0;
            $balanceTran = $receive + $withdraw;
            $balance = $monthlyHistories->balance_start ?? 0;

            if (($receive - $withdraw) > 0) {
                $balance += abs($receive - $withdraw);
            } else {
                $balance -= abs($receive - $withdraw);
            }

            $limitForTheMonth = $this->transactionsService->limitForTheMonth(['user_id' => $request->get('user_id')]);

            $data = [
                'balance' => $balance,
                'receive' => $receive,
                'withdraw' => $withdraw,
                'balanceTran' => $balanceTran,
                'spendingInMonth' => 3000000,
                'spendingInMonthRemaining' => $limitForTheMonth['spendingInMonthRemaining'],
                'limitInDay' => (int) $limitForTheMonth['limitInDay'],
                'limitInDayRemaining' => $limitForTheMonth['limitInDayRemaining'],
            ];
            return ResponseHelper::sendResponse(Response::HTTP_OK, "Lấy dữ liệu dashboard thành công", $data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseHelper::sendResponse(Response::HTTP_BAD_REQUEST, 'Lỗi lấy dữ liệu dashboard');
        }
    }
}
