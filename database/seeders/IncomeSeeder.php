<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Income;

class IncomeSeeder extends Seeder
{
    public function run(): void
    {
        Income::insert([
            [
                'title' => 'Monthly Salary',
                'amount' => 50000,
                'date' => now(),
            ],
            [
                'title' => 'Freelancing',
                'amount' => 20000,
                'date' => now(),
            ]
        ]);
    }
}