<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
		Schema::create('expense_details', function (Blueprint $table) {
			$table->id();

			$table->unsignedBigInteger('expense_id');

			$table->unsignedBigInteger('expense_category_id')->nullable();
			$table->unsignedBigInteger('product_id')->nullable();

			$table->decimal('price', 10, 2);   // 🔥 FIX
			$table->integer('quantity');
			$table->decimal('total', 10, 2);
			$table->string('unit')->nullable();

			$table->timestamps();
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('expense_details');
    }
};