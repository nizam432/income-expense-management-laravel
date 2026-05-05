<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LoanProvider;
use App\Models\Loan;
use App\Models\LoanInstallment;
use App\Models\LoanPayment;

class LoanSeeder extends Seeder
{
    public function run(): void
    {
        $provider = LoanProvider::create([
            'name' => 'DBBL Bank',
            'provider_type' => 'Bank'
        ]);

        $loan = Loan::create([
            'provider_id' => $provider->id,
            'loan_title' => 'Business Loan',
            'loan_amount' => 100000,
            'interest_rate' => 10,
            'total_payable' => 110000,
            'installment_type' => 'monthly',
            'installment_amount' => 10000,
            'installment_count' => 11,
            'start_date' => now(),
        ]);

        for ($i = 1; $i <= 3; $i++) {
            $installment = LoanInstallment::create([
                'loan_id' => $loan->id,
                'installment_no' => $i,
                'amount_paid' => 10000,
                'paid_date' => now(),
            ]);

            LoanPayment::create([
                'loan_id' => $loan->id,
                'installment_id' => $installment->id,
                'paid_amount' => 10000,
            ]);
        }
    }
}