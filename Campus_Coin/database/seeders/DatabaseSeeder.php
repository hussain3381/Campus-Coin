<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Allowance', 'type' => 'income'],
            ['name' => 'Part-time Job', 'type' => 'income'],
            ['name' => 'Scholarship', 'type' => 'income'],
            ['name' => 'Gift', 'type' => 'income'],
            ['name' => 'Other Income', 'type' => 'income'],

            ['name' => 'Food', 'type' => 'expense'],
            ['name' => 'Transport', 'type' => 'expense'],
            ['name' => 'Hostel/Rent', 'type' => 'expense'],
            ['name' => 'Academics', 'type' => 'expense'],
            ['name' => 'Subscriptions', 'type' => 'expense'],
            ['name' => 'Entertainment', 'type' => 'expense'],
            ['name' => 'Miscellaneous', 'type' => 'expense'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                [
                    'user_id' => null,
                    'name' => $category['name'],
                    'type' => $category['type'],
                ],
                [
                    'icon' => null,
                    'is_system' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}