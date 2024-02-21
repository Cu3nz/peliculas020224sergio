<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //todo llamo al factory, pero me guardo en una variable el producto creado para asignarle ids aleatorias

        $movie = Movie::factory(30) -> create();

        foreach ($movie as $peli) {
            $peli -> tags() -> attach(self::devolverTagsIds());
        }
    }



    public static function devolverTagsIds(){

        $tags = [];

        $idsTablaTag = Tag::pluck('id') -> toArray();

        $IndiceRandomTag = array_rand($idsTablaTag , random_int(2,count($idsTablaTag)));

        foreach ($IndiceRandomTag as $indice) {
            $tags [] = $idsTablaTag[$indice];
        }

        return $tags;

    }




}
