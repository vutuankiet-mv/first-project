<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'name' => 'a',
                'author' => 'a',
                'content' => 'a',
            ],
            [
                'name' => 'b',
                'author' => 'b',
                'content' => 'b',
            ],
            [
                'name' => 'd',
                'author' => 'd',
                'content' => 'd',
            ],
        ];
        
        foreach ($books as $book){
            Book::create($book);
        }


    }
}
