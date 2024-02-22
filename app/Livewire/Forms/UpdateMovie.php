<?php

namespace App\Livewire\Forms;

use App\Models\Movie;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateMovie extends Form
{
    //todo variables del formulario 

    public ?Movie $movie = null;

    public string $titulo = "";

    public string $sinopsis = "";

    public  $imagen;

    public string $disponible ="";

    public string $category_id = "";

    public array $tags = [];


    public function setMovie(Movie $movie){
        
        $this -> movie = $movie;
        $this -> titulo = $movie -> titulo;
        $this -> sinopsis = $movie -> sinopsis ;
        $this -> disponible = $movie -> disponible ;
        $this -> category_id = $movie -> category_id ;
        $this -> tags = $movie -> devolverTag() ;
    }


    public function rules(){
        return [
            'titulo' => (['required'  , 'string' , 'min:3' , 'unique:movies,titulo,' . $this -> movie -> id]),
            'sinopsis' => (['required' , 'string' , 'min:10']),
            'disponible' => (['nullable']),
            'category_id' => (['required' , 'exists:categories,id']),
            'tags' => (['required' , 'array' , 'min:2' , 'exists:tags,id'])
        ];
    }



    public function editarMovie(){

        //todo comprobamos  la foto


        $ruta = $this -> movie -> caratula; //? Imagen actual de la movie

        if ($this -> imagen){ //? Si se ha subido una imagen 
            if(basename($ruta) != 'noimage.png'){
                Storage::delete($ruta);
            }            
            
            $ruta=$this->imagen->store('movies'); //? La imagen subida se almacena
        }


        //todo Actualizamos el producto

        $this -> movie -> update([

            'titulo' => $this -> titulo,
            'sinopsis' => $this -> sinopsis,
            'imagen' => $ruta,
            'disponible' => ($this -> disponible) ? 'SI' : 'NO',
            'category_id' => $this -> category_id
        ]);

        $this -> movie -> tags() -> sync($this -> tags); //? Este $this -> tags es de la que esta definida en esta clase
    

    }


    public function limpiarCampos(){
        $this -> reset(['titulo' , 'sinopsis' , 'imagen' , 'disponible' , 'category_id' , 'tags' , 'movie']);
    }

}
