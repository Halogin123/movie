<?php

namespace MovieChill\app\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use MovieChill\Application\MonthlyHistories\MonthlyHistoriesService;
use MovieChill\Application\Transactions\TransactionsService;
use MovieChill\Domain\Enum\TransactionTypeEnum;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private TransactionsService $transactionsService,
        private MonthlyHistoriesService $monthlyHistoriesService
    ) {
    }

    public function index(): View
    {
        $days = [];
        $months = [];
        $oldMouth = $this->transactionsService->countTransactionDayInMonth(Carbon::now()->subMonth()->format('Y-m'));
        $nowMouth = $this->transactionsService->countTransactionDayInMonth(Carbon::now()->format('Y-m'));

        $receiveYear = $this->transactionsService->countTransactionDayInYearWithType(Carbon::now()->format('Y'), TransactionTypeEnum::RECEIVE);
        $withdrawYear = $this->transactionsService->countTransactionDayInYearWithType(Carbon::now()->format('Y'), TransactionTypeEnum::WITHDRAW);

        $totalDayInMonth = Carbon::now()->daysInMonth;

        for ($i = 1; $i <= $totalDayInMonth; $i++) {
            $days[] = str_pad($i, 2, '0', STR_PAD_LEFT);
        }

        for ($i = 1; $i <= 12; $i++) {
            $months[] = str_pad($i, 2, '0', STR_PAD_LEFT);
        }

        $monthlyHistories = $this->monthlyHistoriesService->getMonthlyHistoriesByDate(Carbon::now()->format('Y-m'));

        $receive = $monthlyHistories->total_income ?? 0;
        $withdraw = $monthlyHistories->total_expense ?? 0;
        $balanceTran = $receive + $withdraw;
        $balance = $monthlyHistories->balance_start ?? 0;
        if (($receive - $withdraw) > 0) {
            $balance += abs($receive - $withdraw);
        } else {
            $balance -= abs($receive - $withdraw);
        }


        $limitForTheMonth = $this->transactionsService->limitForTheMonth([]);
        $spendingInMonth = auth()->user()->spending_limit;
        $limitInDay = $limitForTheMonth['limitInDay'];
        $spendingInMonthRemaining = $limitForTheMonth['spendingInMonthRemaining'];
        $limitInDayRemaining = $limitForTheMonth['limitInDayRemaining'];
        $dayRemaining = $limitForTheMonth['dayRemaining'];

        return view('admin.pages.dashboard.index', compact(
            'days',
            'oldMouth',
            'nowMouth',
            'balance',
            'receive',
            'withdraw',
            'balanceTran',
            'months',
            'receiveYear',
            'withdrawYear',
            'spendingInMonth',
            'limitInDay',
            'spendingInMonthRemaining',
            'limitInDayRemaining',
            'dayRemaining',
        ));
    }

}
