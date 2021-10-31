<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpensesTypeSeeder extends Seeder
{
    /**
     * Type of expenses
     */
    protected array $types = [
        'Entertainment',
        'Food',
        'Bills',
        'Transport',
        'Other',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->types as $type) {
            DB::table('expenses_type')->insert([
                'description' => $type,
            ]);
        }
    }
}
