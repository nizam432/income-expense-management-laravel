<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            ['name' => 'Rice','category_id'=>1],
            ['name' => 'Bus Ticket','category_id'=>2],
            ['name' => 'Internet Bill','category_id'=>3],
        ]);
    }
}