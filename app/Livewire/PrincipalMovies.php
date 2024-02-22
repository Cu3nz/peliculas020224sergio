<?php

namespace App\Livewire;

use App\Livewire\Forms\UpdateMovie;
use App\Models\Category;
use App\Models\Movie;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PrincipalMovies extends Component
{


    use WithPagination;
    use WithFileUploads;

    //todo Para el update 

    public UpdateMovie $form;

    public bool $abrirModalUpdate = false;


    public string $orden = "desc";

    public string $campo = 'idm';

    public string $estado = "";

    public string $buscar = "";

    //todo Para el info

    public Movie $pelicula;

    public bool $abrirModalInfo = false;


    #[On('ejecutar_consulta')]

    public function render()
    {
        $movies = Movie::join('categories' , 'categories.id' , '=' , 'category_id')
        ->select('movies.id as idm' , 'titulo'  , 'caratula' , 'disponible' , 'nombre')
        ->where('nombre' , 'like' , "$this->buscar%")
        ->orWhere('disponible' , 'like' , "$this->buscar%")
        ->orWhere('categoria' , 'like' , "$this->buscar%")
        ->orWhere('titulo' , 'like' , "$this->buscar%")
        ->orderBy($this -> campo , $this -> orden)
        ->paginate(5);
        //todo Para el update
        $categorias = Category::orderBy('nombre','asc')->get();
        $Mistags = Tag::select('id','nombre' , 'color') -> get();
        return view('livewire.principal-movies' , compact('movies' , 'categorias' , 'Mistags'));
    }

    public function ordenar($campo){
        $this -> orden = ($this -> orden == 'asc') ? 'desc' : 'asc';

        $this -> campo = $campo;
    }



    public function actualizarDisponibilidad(Movie $movie){


        $estado = ($movie -> disponible == 'NO') ? 'SI' : 'NO';

        $movie -> update([
            'disponible' =>  $estado
        ]);
    }


    public function pedirConfirmacion($id){

        $this -> dispatch('confirmarDelete' , $id);
    }



    
    #[On('deleteConfirmado')]

    public function delete(Movie $movie){

        //todo Primero hago la validacion de la imagen

        if (basename($movie -> caratula) != 'noimagen.png'){
            Storage::delete($movie -> caratula);
        }

        $movie -> delete();

        $this -> dispatch('mensaje' , 'Producto borrado correctametne');

    }


    public function info(Movie $movie){

        
        $this -> pelicula = $movie;


        $this -> abrirModalInfo = true;


    }


    public function salirModalInfo(){
        $this -> reset(['pelicula' , 'abrirModalInfo']);
    }

    public function edit (Movie $movie){

        $this -> form  -> setMovie($movie);
        
        $this -> abrirModalUpdate = true;

    }

    public function updatingBuscar(){
        $this -> resetPage();
    }


    public function update(){

        $this -> form -> editarMovie();

        $this -> salirModalUpdate();


        $this -> dispatch('mensaje' , 'movie actu');


    }


    public function salirModalUpdate(){
        $this -> form -> limpiarCampos();
        $this -> abrirModalUpdate = false;
    }

}
