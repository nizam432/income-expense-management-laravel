<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache (important)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [

            // Product Services
            ['name' => 'product.service.view', 'group_name' => 'Product Services'],
            ['name' => 'product.service.create', 'group_name' => 'Product Services'],
            ['name' => 'product.service.edit', 'group_name' => 'Product Services'],
            ['name' => 'product.service.delete', 'group_name' => 'Product Services'],

            // Expense Category
            ['name' => 'expense.category.view', 'group_name' => 'Expense Category'],
            ['name' => 'expense.category.create', 'group_name' => 'Expense Category'],
            ['name' => 'expense.category.edit', 'group_name' => 'Expense Category'],
            ['name' => 'expense.category.delete', 'group_name' => 'Expense Category'],

            // Expense
            ['name' => 'expense.view', 'group_name' => 'Expense'],
            ['name' => 'expense.create', 'group_name' => 'Expense'],
            ['name' => 'expense.edit', 'group_name' => 'Expense'],
            ['name' => 'expense.delete', 'group_name' => 'Expense'],

            // Income
            ['name' => 'income.view', 'group_name' => 'Income'],
            ['name' => 'income.create', 'group_name' => 'Income'],
            ['name' => 'income.edit', 'group_name' => 'Income'],
            ['name' => 'income.delete', 'group_name' => 'Income'],

            // Dashboard
            ['name' => 'dashboard.view', 'group_name' => 'Dashboard'],

            // Reports
            ['name' => 'reports.daily_report', 'group_name' => 'Report'],
            ['name' => 'reports.monthly_report', 'group_name' => 'Report'],
            ['name' => 'reports.product_wise_report', 'group_name' => 'Report'],
            ['name' => 'reports.income_and_expense', 'group_name' => 'Report'],
            ['name' => 'reports.category_wise', 'group_name' => 'Report'],
            ['name' => 'reports.income_vs_expense', 'group_name' => 'Report'],

            // Manage Users
            ['name' => 'manage.users.view', 'group_name' => 'Manage User'],
            ['name' => 'manage.users.create', 'group_name' => 'Manage User'],
            ['name' => 'manage.users.edit', 'group_name' => 'Manage User'],
            ['name' => 'manage.users.delete', 'group_name' => 'Manage User'],

            // Loan Management
            ['name' => 'loan.management.view', 'group_name' => 'Loan Management'],
            ['name' => 'loan.management.create', 'group_name' => 'Loan Management'],
            ['name' => 'loan.management.payment', 'group_name' => 'Loan Management'],

            // Provider
            ['name' => 'loan.provider.view', 'group_name' => 'Provider'],
            ['name' => 'loan.provider.create', 'group_name' => 'Provider'],
            ['name' => 'loan.provider.edit', 'group_name' => 'Provider'],
        ];

        // Insert / Update permissions
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                [
                    'group_name' => $permission['group_name'],
                    'guard_name' => 'web',
                ]
            );
        }

        // Create Admin Role
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // Assign ALL permissions to admin (BEST WAY)
        $adminRole->syncPermissions(Permission::all());

        // Assign role to user
        $user = User::where('email', 'admin@example.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}