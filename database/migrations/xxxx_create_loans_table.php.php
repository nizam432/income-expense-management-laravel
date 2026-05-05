<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('provider_id');

            $table->string('loan_title');
            $table->decimal('loan_amount', 10, 2);
            $table->decimal('interest_rate', 5, 2)->nullable();

            $table->decimal('total_payable', 10, 2);

            $table->string('installment_type'); // monthly/weekly
            $table->decimal('installment_amount', 10, 2);
            $table->integer('installment_count');

            $table->date('start_date');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};