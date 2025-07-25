<?php

namespace Ducnm\Application\MonthlyHistories;

use Ducnm\app\Models\MonthlyHistories;
use Carbon\Carbon;
use Ducnm\Domain\Enum\TransactionTypeEnum;
use Ducnm\Domain\ModelV2\TransactionsInterface;
use Ducnm\Infrastructure\Persistance\MysqlV2\MonthlyHistoriesRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MonthlyHistoriesService
{
    public function __construct(
        private MonthlyHistoriesRepository $monthlyHistoriesRepository,
        private TransactionsInterface $transactionsRepository
    ) {
    }

    public function getMonthlyHistoriesByDate($date, $userId = null)
    {
        $month = Carbon::createFromFormat('Y-m', $date)->month;
        $year = Carbon::createFromFormat('Y-m', $date)->year;

        return $this->monthlyHistoriesRepository->findOne([
            'where' => ['month' => $month, 'year' => $year, 'user_id' => $userId ?: auth()->id()]
        ]);
    }

    public function updateMonthlyHistories(): void
    {
        DB::beginTransaction();
        try {
            $date =  Carbon::now();
            $dateOld = Carbon::now()->subMonth();

            $year = $date->format('Y');
            $month = $date->format('m');

            $monthOld = $dateOld->month;
            $yearOld = $dateOld->year;

            $dateTime = $year . '-' . $month;
            $transactions = $this->transactionsRepository->findMany([
                'like' => ['executed_at' => $dateTime . '%']
            ]);

            // nhận
            $receive = 0;
            // rút
            $withdraw = 0;
            //tiền cuối kì
            $balanceEnd = $this->monthlyHistoriesRepository->findOne([
                'where' => ['month' => $monthOld, 'year' => $yearOld, 'user_id' => auth()->id()]
            ])->balance_end;

            foreach ($transactions as $transaction) {
                if ($transaction->transaction_type == TransactionTypeEnum::RECEIVE) {
                    $receive += $transaction->amount;
                }

                if ($transaction->transaction_type == TransactionTypeEnum::WITHDRAW) {
                    $withdraw += $transaction->amount;
                }
            }

            if (($receive - $withdraw) > 0) {
                $balanceEnd += abs($receive - $withdraw);
            } else {
                $balanceEnd -= abs($receive - $withdraw);
            }

            $paramUpdate = [
                'total_income' => $receive,
                'total_expense' => $withdraw,
                'balance_end' => $balanceEnd,
            ];


            $this->monthlyHistoriesRepository->updateBy([
                'where' => ['month' => $month, 'year' => $year, 'user_id' => auth()->id()]
            ], $paramUpdate);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new \Exception('Lỗi thực hiện tính lại giao dịch');
        }
    }
}
