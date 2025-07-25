<?php

namespace Ducnm\Application\Transactions;

use Carbon\Carbon;
use Ducnm\Domain\Enum\TransactionTypeEnum;
use Ducnm\Infrastructure\Persistance\MysqlV2\MonthlyHistoriesRepository;
use Ducnm\Infrastructure\Persistance\MysqlV2\TransactionsRepository;
use Ducnm\Infrastructure\Persistance\MysqlV2\UserRepository;

class TransactionsService
{
    public function __construct(
        private TransactionsRepository $transactionsRepository,
        private MonthlyHistoriesRepository $monthlyHistoriesRepository,
        private UserRepository $userRepository
    ) {
    }

    public function getTransactionsByMonthAndYear($startDate, $endDate)
    {
        return $this->transactionsRepository->getAllTransactions([
            'paginate' => true,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'user_id' => auth()->id()
        ]);
    }

    public function getAllTransactionsByMonthAndYear($startDate, $endDate, $userId)
    {
        return $this->transactionsRepository->getAllTransactions([
            'paginate' => false,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'user_id' => $userId
        ]);
    }

    public function countTransactionDayInMonth($month)
    {
        $transactions = $this->transactionsRepository->findMany(
            [
                'like' => ['executed_at' => $month],
                'where' => ['user_id' => auth()->id()]
            ],
        );

        $amountDays = [];

        for ($i = 0; $i < 31; $i++) {
            $amountDay[$i] = 0;
            foreach ($transactions as $transaction) {
                $day = Carbon::createFromFormat('Y-m-d H:i:s', $transaction->executed_at)->format('d');
                if (((int)$day === $i + 1)) {
                    if ($transaction->transaction_type === TransactionTypeEnum::RECEIVE) {
                        $amountDay[$i] += $transaction->amount;
                    } else if ($transaction->transaction_type === TransactionTypeEnum::WITHDRAW) {
                        $amountDay[$i] -= $transaction->amount;
                    }
                }
            }

            $amountDays[$i] = ($amountDay[$i]);
        }

        return $amountDays;
    }

    public function countTransactionDayInYearWithType($month, $type)
    {
        $transactions = $this->transactionsRepository->findMany([
            'like' => ['executed_at' => $month],
            'where' => [
                'transaction_type' => $type,
                'user_id' => auth()->id()
            ]
        ]);

        $amountDays = [];

        for ($i = 0; $i < 12; $i++) {
            $amountDay[$i] = 0;
            foreach ($transactions as $transaction) {
                $day = Carbon::createFromFormat('Y-m-d H:i:s', $transaction->executed_at)->format('m');
                if (((int)$day === $i + 1)) {
                    $amountDay[$i] += $transaction->amount;
                }
            }

            $amountDays[$i] = ($amountDay[$i]);
        }

        return $amountDays;
    }

    public function sumTransactionInMonthWithType($month, $type)
    {
        $transactions = $this->transactionsRepository->findMany([
            'like' => ['executed_at' => $month],
            'where' => [
                'transaction_type' => $type,
                'user_id' => auth()->id()
            ]
            ])->sum('amount');
        return ($transactions);
    }

    public function sumTransactionInMonth($month)
    {
        $transactions = $this->transactionsRepository->findMany([
            'like' => ['executed_at' => $month],
            'where' => ['user_id' => auth()->id()]
        ])->sum('amount');

        return number_format($transactions);
    }

    public function createTransaction($request): void
    {
        $param = $this->_formatDataTransaction([
            'to_account_id' => $request['to_account_id'] ?? '',
            'transaction_type' => $request['transaction_type'] ?? '',
            'amount' => $request['amount'] ?? 0,
            'description' => $request['description'] ?? '',
            'executed_at' => $request['executed_at'] ?? '',
            'user_id' => $request['user_id'] ?? '',
        ]);

        $this->transactionsRepository->create($param);
        $this->updateMonthlyHistory($param);
    }

    public function updateMonthlyHistory($param)
    {
        $date = Carbon::now();
        $dateOld = Carbon::now()->subMonth();

        $month = $date->month;
        $year = $date->year;

        $monthOld = $dateOld->month;
        $yearOld = $dateOld->year;

        $monthlyHistory = $this->monthlyHistoriesRepository->findOne([
            'where' => ['year' => $year, 'month' => $month, 'user_id' => $param['user_id'] ?: auth()->id()]
        ]);

        $monthlyHistoryOld = $this->monthlyHistoriesRepository->findOne([
            'where' => ['year' => $yearOld, 'month' => $monthOld, 'user_id' => $param['user_id'] ?: auth()->id()]
        ]);

        if (empty($monthlyHistory)) {
            $param = [
                'balance_start' => $monthlyHistoryOld->balance_end,
                'user_id' => $param['user_id'] ?: auth()->id(),
                'year' => $year,
                'month' => $month,
            ];

            return $this->monthlyHistoriesRepository->create($param);
        }

        $totalIncome = ($monthlyHistory->total_income ?? 0);
        $totalExpense = ($monthlyHistory->total_expense ?? 0);

        if ($param['transaction_type'] == TransactionTypeEnum::RECEIVE) {
            $totalIncome += $param['amount'];
        }

        if ($param['transaction_type'] == TransactionTypeEnum::WITHDRAW) {
            $totalExpense += $param['amount'];
        }

        $balanceStart = $monthlyHistoryOld->balance_end ?? 0;
        $balanceEnd =  $monthlyHistoryOld->balance_end ?? 0;
        if (($totalIncome - $totalExpense) > 0) {
            $balanceEnd += abs($totalIncome - $totalExpense);
        } else {
            $balanceEnd -= abs($totalIncome - $totalExpense);
        }

        $this->monthlyHistoriesRepository->createOrUpdate(['where' => [
            'month' => $month,
            'year' => $year,
        ]], [
            'month' => $month,
            'year' => $year,
            'total_income' => $totalIncome,
            'total_expense' => $totalExpense,
            'balance_start' => $balanceStart,
            'balance_end' => $balanceEnd,
        ]);
    }

    public function importTransactions()
    {

    }

    private function _formatDataTransaction($param): array
    {
        $res = [];

        $res['to_account_id'] = $param['to_account_id'] ?? '';
        $res['transaction_type'] = $param['transaction_type'] ?? '';
        $res['amount'] = $param['amount'] ?? '';
        $res['description'] = $param['description'] ?? '';
        $res['created_at'] = $param['created_at'] ?? Carbon::now();
        $res['updated_at'] = $param['updated_at'] ?? Carbon::now();
        $res['executed_at'] = $param['executed_at'] ?: Carbon::now();
        $res['user_id'] = $param['user_id'] ?: auth()->id();

        return $res;
    }

    public function limitForTheMonth($param)
    {
        if (!empty($param['user_id'])) {
            $user = $this->userRepository->findById($param['user_id']);
            $spendingInMonth = $user->spending_limit;
            $payPeriod = $user->pay_period;
        } else {
            $spendingInMonth = auth()->user()->spending_limit;
            $payPeriod = auth()->user()->pay_period;
        }

        $day = Carbon::now()->day;

        if ($day > $payPeriod) {
            $startDate = Carbon::now()->format('Y-m') . "-" . ($payPeriod + 1);
            $endDate = Carbon::now()->addMonth()->format('Y-m') . "-" . $payPeriod;
        } else {
            $startDate = Carbon::now()->subMonth()->format('Y-m') . "-" . ($payPeriod + 1);
            $endDate = Carbon::now()->format('Y-m') . "-" . $payPeriod;
        }

        $startDateFormat = Carbon::createFromFormat('Y-m-d', $startDate)->startOfDay();
        $endDateFormat = Carbon::createFromFormat('Y-m-d', $endDate)->endOfDay();
        $totalDayInMonth = $startDateFormat->daysUntil($endDateFormat)->count();

        // lấy giao dịch nhận từ ngày $payPeriod + 1 đến $payPeriod
        $receiveData = $this->transactionsRepository->findMany([
            'select' => ['amount'],
            'between' => ['executed_at' => [$startDateFormat->format('Y-m-d H:i:s'), $endDateFormat->format('Y-m-d H:i:s')]],
            'where' => ['transaction_type' => TransactionTypeEnum::RECEIVE],
        ])->toArray();
        $receive = array_sum(array_column($receiveData, 'amount'));

        $withdrawData = $this->transactionsRepository->findMany([
            'select' => ['amount'],
            'between' => ['executed_at' => [$startDateFormat->format('Y-m-d H:i:s'), $endDateFormat->format('Y-m-d H:i:s')]],
            'where' => ['transaction_type' => TransactionTypeEnum::WITHDRAW],
        ])->toArray();
        $withdraw = array_sum(array_column($withdrawData, 'amount'));

        $limitInDay = $spendingInMonth / $totalDayInMonth;

        // tiền còn lại trong tháng
        if (($receive - $withdraw) > 0) {
            $spendingInMonthRemaining = $spendingInMonth + (int)abs($receive - $withdraw);
        } else {
            $spendingInMonthRemaining = $spendingInMonth - (int)abs($receive - $withdraw);
        }

        $dayRemaining = Carbon::now()->diffInDays($endDateFormat) + 1;

        // có thể tiêu trong ngày
        $limitInDayRemaining = (int) ($spendingInMonthRemaining / $dayRemaining);

        $res = [
            'spendingInMonthRemaining' => $spendingInMonthRemaining,
            'limitInDay' => $limitInDay,
            'limitInDayRemaining' => $limitInDayRemaining,
            'dayRemaining' => $dayRemaining,
        ];

        return $res;
    }
}
