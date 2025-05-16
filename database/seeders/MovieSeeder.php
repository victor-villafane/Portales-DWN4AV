<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movies')->insert([
                [
                    'movie_id' => 5,
                    'title' => 'The Shawshank Redemption',
                    'price' => 10,
                    'release_date' => '1994-09-23',
                    'synopsis' => 'Two imprisoned',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'movie_id' => 6,
                    'title' => 'The Godfather',
                    'price' => 12,
                    'release_date' => '1972-03-24',
                    'synopsis' => 'An organized crime dynasty',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'movie_id' => 7,
                    'title' => 'The Dark Knight',
                    'price' => 15,
                    'release_date' => '2008-07-18',
                    'synopsis' => 'When the menace known as the Joker emerges from his mysterious past',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
    }
}
