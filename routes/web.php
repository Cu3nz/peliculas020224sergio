<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\TagController;
use App\Livewire\PrincipalMovies;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('tag' , TagController::class);
    Route::resource('categories' , CategoryController::class);

    Route::get('movies' , PrincipalMovies::class) -> name('movies.index');

});


//todo Para el correo: 

Route::get('contacto' , [ContactoController::class , 'pintarFormulario']) -> name('email.pintar');
Route::post('contacto' , [ContactoController::class , 'procesarFormulario']) -> name('email.procesar');
