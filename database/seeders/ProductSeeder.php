<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            ['name' => 'Rice'],
            ['name' => 'Bus Ticket'],
            ['name' => 'Internet Bill'],
        ]);
    }
}