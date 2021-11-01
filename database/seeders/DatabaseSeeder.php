<?php

namespace Database\Seeders;

use App\Models\Expenses;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeders
        $this->call([
            ExpensesTypeSeeder::class,
        ]);

        // Factories
        Expenses::factory(25)->create();
    }
}
