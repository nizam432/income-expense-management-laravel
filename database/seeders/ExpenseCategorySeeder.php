<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExpenseCategory;

class ExpenseCategorySeeder extends Seeder
{
    public function run(): void
    {
        ExpenseCategory::insert([
            ['name' => 'Food', 'description' => 'Daily food expense'],
            ['name' => 'Transport', 'description' => 'Travel cost'],
            ['name' => 'Bills', 'description' => 'Utility bills'],
            ['name' => 'Shopping', 'description' => 'Personal shopping'],
        ]);
    }
}