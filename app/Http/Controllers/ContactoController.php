<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ContactoMaillabe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    //

    public function pintarFormulario(){

        return view('contactoForm.formulario');

    }



    public function procesarFormulario(Request $request){
        //todo Hacemos validaciones y el trycahtch

        $request -> validate([
            'nombre' => ['required' , 'string' , 'min:3'],
            'email' => ['required' , 'email'],
            'contenido' => ['required' , 'string' ,'min:10']
        ]);

        try {
            Mail::to('sergio@example.com') -> send(new ContactoMaillabe(ucfirst($request -> nombre) , $request -> email, ucfirst($request -> contenido)));
            return redirect() -> route('dashboard') -> with('mensaje' , 'Se ha podido  enviar el mensaje');
        } catch (\Exception $ex) {
            dd("No se ha podido enviar el correo" . $ex -> getMessage());
            return redirect() -> route('dashboard') -> with('mensaje' , 'no se ha podido enviar el mensaje');
        }

    }

}
