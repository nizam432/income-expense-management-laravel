<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;
use App\Models\ExpenseDetail;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $expense = Expense::create([
			'title' => 'Daily expense', 
            'expense_date' => now(),
            'note' => 'Daily expense',
            'total_amount' => 1500
        ]);

        ExpenseDetail::insert([
            [
                'expense_id' => $expense->id,
                'expense_category_id' => 1,

                'product_id' => 1,
                'unit' => 'kg',
                'quantity' => 2,
                'price' => 50,
                'total' => 100,
            ],
            [
                'expense_id' => $expense->id,
                'expense_category_id' => 2,
                'product_id' => 2,
                'unit' => 'pcs',
                'quantity' => 1,
                'price' => 50,
                'total' => 50,
            ]
        ]);
    }
}