<?php

namespace App\Livewire;

use App\Models\Movie;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PrincipalMovies extends Component
{


    use WithPagination;


    public string $orden = "desc";

    public string $campo = 'idm';

    public string $estado = "";



    public function render()
    {
        $movies = Movie::join('categories' , 'categories.id' , '=' , 'category_id')
        ->select('movies.id as idm' , 'titulo'  , 'caratula' , 'disponible' , 'nombre')
        ->orderBy($this -> campo , $this -> orden)
        ->paginate(5);
        return view('livewire.principal-movies' , compact('movies'));
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

}
