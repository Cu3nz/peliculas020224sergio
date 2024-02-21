<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];


    //todo Relacion 1:N Una categoria cuantas peliculas puede teneer? Muchas 


    public function movies(){
        return $this -> hasMany(Movie::class);
    }



    public function nombre(){
        return Attribute::make(
            set:fn($v) => ucfirst($v)
        );
    }

}
