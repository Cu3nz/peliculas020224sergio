<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categoria = Category::orderBy('id' , 'desc') -> paginate(5);
        return view('categorias.index' , compact('categoria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request -> validate([
            'nombre' => ['required' , 'string' , 'min:3' , 'unique:categories,nombre']
        ]);

        //todo Una vez pasadas las validaciones, creamos el producto 

        Category::create($request -> all());

        return redirect() -> route('categories.index') -> with('mensaje' , 'Categoria creada');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // 
        return view('categorias.update' , compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $request -> validate([
            'nombre' => ['required' , 'string' , 'min:3' , 'unique:categories,nombre,'. $category -> id]
        ]);

        //todo Una vez pasadas las validaciones, creamos el producto 

        Category::create($request -> all());

        return redirect() -> route('categories.index') -> with('mensaje' , 'Categoria actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //

        $category -> delete();

        return redirect() -> route('categories.index') -> with('mensaje' , 'Categoria borrada');

    }
}
