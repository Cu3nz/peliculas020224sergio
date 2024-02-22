<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Movie;
use App\Models\Tag;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearMovies extends Component
{

    use WithFileUploads;

    public bool $abrirModalCreate = false;

    #[Validate(['required'  , 'string' , 'min:3' , 'unique:movies,titulo'])]
    public string $titulo = "";

    #[Validate(['required' , 'string' , 'min:10'])]
    public string $sinopsis = "";

    #[Validate(['required' , 'exists:categories,id'])]
    public string $category_id = "";
    
    #[Validate(['nullable'])]
    public string $disponible = "";

    #[Validate(['required' , 'array' , 'min:2' , 'exists:tags,id'])]
    public array $tags = []; 

    #[Validate(['nullable' , 'image' , 'max:2048'])]
    public $imagen;

    public function render()
    {
        $categorias = Category::orderBy('nombre','asc')->get();
        $Mistags = Tag::select('id','nombre' , 'color') -> get();
        return view('livewire.crear-movies' ,compact('categorias' , 'Mistags'));
    }


    //todo Metodo store el cual pasa las validaciones y crear el objeto

    public function store(){
        $this -> validate();

        //todo Almaceno la peli creada en la variable, para asignarle los tags seleccionamso en el formulario a esa movie
        $pelicula= Movie::create([

            'titulo' => $this -> titulo,
            'sinopsis' => $this -> sinopsis,
            'disponible' => ($this -> disponible) ? 'SI' : 'NO',
            'category_id' => $this -> category_id,
            'caratula' => ($this -> imagen) ? $this -> imagen -> store('movies') : 'noimage.png',
        ]);

        //todo Asignarle los tags seleccionados a la pelicula creada

        $pelicula -> tags() ->  attach($this -> tags);


        //? Enviamos un evento que solo lo va a escuchar la clase principal 

        $this -> dispatch('ejecutar_consulta') -> to(PrincipalMovies::class);

        $this -> dispatch('mensaje' , 'Movie creada correctamete');

        $this -> salirModalCreate();

    }


    public function salirModalCreate(){
        $this -> reset('titulo' , 'sinopsis' , 'imagen' , 'tags' , 'abrirModalCreate' , 'disponible' , 'category_id');
    }


}
