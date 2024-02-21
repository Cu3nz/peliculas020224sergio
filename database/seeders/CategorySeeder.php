<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $categoriasPeliculas = [
            'Acción',
            'Comedia',
            'Drama',
            'Terror',
            'Ciencia Ficción',
            'Fantasía',
            'Documental',
            'Aventura',
            'Romance',
            'Suspenso',
            'Animación',
            'Musical',
            'Histórica',
            'Guerra',
            'Crimen',
            'Misterio',
            'Biográfica',
            'Deporte',
            'Familia',
            'Western',
        ];

        foreach ($categoriasPeliculas as $nombre) {
            Category::create(compact('nombre'));
        }

    }
}
