<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SavingTipSeeder extends Seeder
{
    public function run(): void
    {
        $tips = [
            [
                'category' => 'Food',
                'title' => 'Plan meals before the week',
                'description' => 'Before ordering or buying meals, set a weekly food limit and compare your recorded spending with it.',
            ],
            [
                'category' => 'Transport',
                'title' => 'Review your campus travel costs',
                'description' => 'At the end of the week, review transport entries and consider whether any trips could be grouped conveniently.',
            ],
            [
                'category' => 'Academics',
                'title' => 'Check book options before buying',
                'description' => 'Before buying a new textbook, check whether the library or a legitimate second-hand copy is available.',
            ],
            [
                'category' => 'Subscriptions',
                'title' => 'Review recurring subscriptions',
                'description' => 'List your active subscriptions and review whether you still use each one before the next renewal.',
            ],
            [
                'category' => 'Entertainment',
                'title' => 'Set an outing limit in advance',
                'description' => 'Decide an amount that fits your budget before an outing, then compare your expense entries with that limit.',
            ],
            [
                'category' => null,
                'title' => 'Review your budget once a week',
                'description' => 'Spend a few minutes each week comparing your recorded transactions with your category budgets.',
            ],
        ];

        foreach ($tips as $tip) {
            $categoryId = $tip['category']
                ? DB::table('categories')
                    ->whereNull('user_id')
                    ->where('name', $tip['category'])
                    ->value('id')
                : null;

            DB::table('saving_tips')->updateOrInsert(
                ['title' => $tip['title']],
                [
                    'category_id' => $categoryId,
                    'description' => $tip['description'],
                    'estimated_saving_pkr' => null,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}