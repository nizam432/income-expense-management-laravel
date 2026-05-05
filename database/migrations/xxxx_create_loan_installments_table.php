<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('loan_installments', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('loan_id');

    $table->integer('installment_no');

    // 🔥 ADD THIS
    $table->decimal('amount_paid', 10, 2)->default(0);

    $table->date('due_date')->nullable();
    $table->date('paid_date')->nullable();

    $table->enum('status', ['pending', 'paid'])->default('pending');

    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_installments');
    }
};