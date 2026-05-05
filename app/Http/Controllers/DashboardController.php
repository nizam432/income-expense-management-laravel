<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Permission middleware (enable when needed)
        // $this->middleware('permission:dashboard.view')->only(['index', 'filter']);
    }

    /**
     * =========================
     * Dashboard Default View
     * =========================
     */
    public function index()
    {
        [$startDate, $endDate] = $this->getDefaultDateRange();

        $data = $this->getDashboardData($startDate, $endDate);

        return view('dashboard', $data);
    }

    /**
     * =========================
     * AJAX Filter
     * =========================
     */
    public function filter(Request $request)
    {
        $startDate = $request->start_date ?? Carbon::now()->startOfMonth()->toDateString();
        $endDate   = $request->end_date ?? Carbon::now()->endOfMonth()->toDateString();

        $data = $this->getDashboardData($startDate, $endDate);

        return response()->json($data);
    }

    /**
     * =========================
     * Main Dashboard Data
     * =========================
     */
    private function getDashboardData($startDate, $endDate)
    {
        $totalIncome = $this->getTotalIncome($startDate, $endDate);
        $totalExpense = $this->getTotalExpense($startDate, $endDate);

        return [
            'totalIncome'    => $totalIncome,
            'totalExpense'   => $totalExpense,
            'currentBalance' => $totalIncome - $totalExpense,

            'dates'          => $this->getDailyExpenseDates($startDate, $endDate),
            'totals'         => $this->getDailyExpenseTotals($startDate, $endDate),

            'categoryLabels' => $this->getCategoryLabels($startDate, $endDate),
            'categoryTotals' => $this->getCategoryTotals($startDate, $endDate),
        ];
    }

    /**
     * =========================
     * Income
     * =========================
     */
    private function getTotalIncome($startDate, $endDate)
    {
        return DB::table('incomes')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('amount');
    }

    /**
     * =========================
     * Expense Total
     * =========================
     */
    private function getTotalExpense($startDate, $endDate)
    {
        return DB::table('expense_details')
            ->join('expenses', 'expense_details.expense_id', '=', 'expenses.id')
            ->whereBetween('expenses.expense_date', [$startDate, $endDate])
            ->sum('expense_details.total');
    }

    /**
     * =========================
     * Daily Expense Chart Dates
     * =========================
     */
    private function getDailyExpenseDates($startDate, $endDate)
    {
        return DB::table('expense_details')
            ->join('expenses', 'expense_details.expense_id', '=', 'expenses.id')
            ->whereBetween('expenses.expense_date', [$startDate, $endDate])
            ->selectRaw('DATE(expenses.expense_date) as date')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('date');
    }

    /**
     * =========================
     * Daily Expense Totals
     * =========================
     */
    private function getDailyExpenseTotals($startDate, $endDate)
    {
        return DB::table('expense_details')
            ->join('expenses', 'expense_details.expense_id', '=', 'expenses.id')
            ->whereBetween('expenses.expense_date', [$startDate, $endDate])
            ->selectRaw('SUM(expense_details.total) as total')
            ->groupByRaw('DATE(expenses.expense_date)')
            ->orderByRaw('DATE(expenses.expense_date)')
            ->pluck('total');
    }

    /**
     * =========================
     * Category Labels
     * =========================
     */
    private function getCategoryLabels($startDate, $endDate)
    {
        return DB::table('expense_details')
            ->join('expenses', 'expense_details.expense_id', '=', 'expenses.id')
            ->join('expense_categories', 'expense_details.expense_category_id', '=', 'expense_categories.id')
            ->whereBetween('expenses.expense_date', [$startDate, $endDate])
            ->groupBy('expense_categories.id', 'expense_categories.name')
            ->pluck('expense_categories.name');
    }

    /**
     * =========================
     * Category Totals
     * =========================
     */
    private function getCategoryTotals($startDate, $endDate)
    {
        return DB::table('expense_details')
            ->join('expenses', 'expense_details.expense_id', '=', 'expenses.id')
            ->join('expense_categories', 'expense_details.expense_category_id', '=', 'expense_categories.id')
            ->whereBetween('expenses.expense_date', [$startDate, $endDate])
            ->groupBy('expense_categories.id', 'expense_categories.name')
            ->selectRaw('SUM(expense_details.total) as total')
            ->pluck('total');
    }

    /**
     * =========================
     * Default Date Range
     * =========================
     */
    private function getDefaultDateRange()
    {
        return [
            Carbon::now()->startOfMonth()->toDateString(),
            Carbon::now()->endOfMonth()->toDateString(),
        ];
    }
}