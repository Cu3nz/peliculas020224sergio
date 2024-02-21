<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $etiquetasPeliculas = [
            'Acción' => '#ff0000', // Rojo
            'Comedia' => '#ffff00', // Amarillo
            'Drama' => '#0000ff', // Azul
            'Terror' => '#000000', // Negro
            'Ciencia Ficción' => '#8a2be2', // Azul violeta
            'Fantasía' => '#dda0dd', // Ciruela
            'Documental' => '#008000', // Verde
            'Aventura' => '#ffa500', // Naranja
            'Romance' => '#ff69b4', // Rosa intenso
            'Suspenso' => '#708090', // Gris pizarra
            'Animación' => '#00ffff', // Cian
            'Musical' => '#ff4500', // Rojo an
        ];
        
        foreach ($etiquetasPeliculas as $nombre => $color) {
            
            Tag::create(compact('nombre' , 'color'));

        }

    }
}
