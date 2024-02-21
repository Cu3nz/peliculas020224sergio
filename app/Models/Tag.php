<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['nombre' , 'color'];

    //? Relacion N:M Una etiqueta en cuantas peliculas puede estar definida? En muchas

    public function movies(){
        return $this -> belongsToMany(Movie::class);
    }


    public function nombre(){
        return  Attribute::make(
            set: fn($v) => ucfirst($v)
        );
    }

}
