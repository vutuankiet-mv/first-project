<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = 
        [
            [
                'name' => 'kiet',
                'address' => 'binh duong',
                'phone' => '09451236',
            ],
             [
                'name' => 'bao',
                'address' => 'ho chi minh',
                'phone' => '123456789',
            ],
        ];
        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
