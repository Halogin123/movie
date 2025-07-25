<?php

namespace MovieChill\app\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use MovieChill\Application\MonthlyHistories\MonthlyHistoriesService;
use MovieChill\Application\Transactions\TransactionsService;
use MovieChill\Domain\Enum\TransactionTypeEnum;
use MovieChill\Infrastructure\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionsController extends Controller
{
    public function __construct(
        private TransactionsService $transactionsService,
        private MonthlyHistoriesService $monthlyHistoriesService
    ) {
    }

    public function index(Request $request)
    {
        $startDate = $request->get('start_date') ? Carbon::createFromFormat('m/d/Y', $request->get('start_date'))->startOfDay() : Carbon::now()->startOfMonth();
        $endDate = $request->get('end_date') ? Carbon::createFromFormat('m/d/Y', $request->get('end_date'))->endOfDay() : Carbon::now()->endOfMonth();

        $transactions = $this->transactionsService->getTransactionsByMonthAndYear($startDate, $endDate);

        $totalAmount = 100000;

        return view('admin.pages.transactions.index', compact('transactions', 'totalAmount'));
    }

    public function create()
    {
        $types = TransactionTypeEnum::cases();

        return view('admin.pages.transactions.create', compact('types'));
    }

    public function store(Request $request)
    {
        $response = [];

        try {
            $this->transactionsService->createTransaction($request->all());
            $response['url-return'] = route('admin.transactions.index');
        } catch (\Exception $e) {
            return ResponseHelper::sendResponse(Response::HTTP_INTERNAL_SERVER_ERROR, "Tạo giao dịch thất bại", $response);
        }

        return ResponseHelper::sendResponse(Response::HTTP_OK, "Tạo giao dịch thành công", $response);
    }

    public function countTransactions()
    {
        $response = [];
        try {
            $this->monthlyHistoriesService->updateMonthlyHistories();
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect()->route('transactions.index');
        }
    }

    public function importTransactions(Request $request)
    {

        return ResponseHelper::sendResponse(Response::HTTP_OK, "Import transactions functionality is not implemented yet.");
    }
}
