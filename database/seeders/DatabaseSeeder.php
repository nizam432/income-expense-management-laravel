<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            RolePermissionSeeder::class,
            ExpenseCategorySeeder::class,
            ProductSeeder::class,
            IncomeSeeder::class,
            ExpenseSeeder::class,
            LoanSeeder::class,
        ]);
    }
}