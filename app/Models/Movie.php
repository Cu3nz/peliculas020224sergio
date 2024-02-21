<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['titulo' , 'caratula' , 'sinopsis' , 'disponible' , 'category_id'];


    //todo Relacion 1:N

    //? Una pelicula cuantas categorias puede tener? 1

    public function category(){
        return $this -> belongsTo(Category::class);
    }


    //todo Relacion N:M 

    //? Una pelicula, cuantas etiquetas puede tener? Muchas
    public function tags(){
        return $this -> belongsToMany(Tag::class);
    }

    public function nombre(){
        return Attribute::make(
            set:fn($v) => ucfirst($v)
        );
    }
    public function descripcion(){
        return Attribute::make(
            set:fn($v) => ucfirst($v)
        );
    }

}
