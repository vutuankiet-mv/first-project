<?php

namespace Database\Seeders;

use App\Models\Tool;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tools = [
            [
                'name' => 'keo',
                'description' => 'qqqqq',
            ],
            [
                'name' => 'bua',
                'description' => 'aaaaaa',
            ],
        ];
        foreach ($tools as $tool) {
            Tool::create(
                $tool
            );
        }
    }
}
