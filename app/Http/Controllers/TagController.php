<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LVR\Colour\Hex;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tag = Tag::orderBy('id','desc')->paginate(2);
        return view('tag.index',compact('tag'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request -> validate([

            'nombre' => ['required' , 'string' , 'min:3' , 'unique:tags,nombre'],
            'color' => ['required' , new Hex ]
        ]);

        Tag::create($request -> all());

        return redirect() -> route('tag.index') -> with('mensaje' , 'tag creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //

        return view('tag.update' , compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        //
        $request -> validate([

            'nombre' => ['required' , 'string' , 'min:3' , 'unique:tags,nombre,'. $tag -> id],
            'color' => ['required' , new Hex ]
        ]);

        $tag -> update($request -> all());

        return redirect() -> route('tag.index') -> with('mensaje' , 'tag creado');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //

        $tag -> delete();

        return redirect() -> route('tag.index') -> with('mensaje' , 'tag borrado');


    }
}
