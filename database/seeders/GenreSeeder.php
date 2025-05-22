<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            [ 'genre_id' => 1, 'name' => 'Animacion', 'created_at' => now(), 'updated_at' => now() ],
            [ 'genre_id' => 2, 'name' => 'Accion', 'created_at' => now(), 'updated_at' => now() ],
            [ 'genre_id' => 3, 'name' => 'Comedia', 'created_at' => now(), 'updated_at' => now() ],
            [ 'genre_id' => 4, 'name' => 'Drama', 'created_at' => now(), 'updated_at' => now() ],
            [ 'genre_id' => 5, 'name' => 'Terror', 'created_at' => now(), 'updated_at' => now() ],
            [ 'genre_id' => 6, 'name' => 'Romance', 'created_at' => now(), 'updated_at' => now() ],
            [ 'genre_id' => 7, 'name' => 'Ciencia Ficcion', 'created_at' => now(), 'updated_at' => now() ],
            [ 'genre_id' => 8, 'name' => 'Documental', 'created_at' => now(), 'updated_at' => now() ]
        ]);
    }
}
