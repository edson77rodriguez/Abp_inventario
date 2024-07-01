<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;

class GeneroController extends Controller
{
    public function index()
    {
        $generos = Genero::all();
        return view('generos.index', compact('generos'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
    
        Genero::create($validatedData);
    
        return redirect()->route('generos.index')->with('register',' ');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
    
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
        $genero = Genero::find($id);
        $genero->update($request->all());

        return redirect()->route('generos.index')->with('modify',' ');
    }

    public function destroy(string $id)
    {
        $genero = Genero::findOrFail($id);
        $genero->delete();

        return redirect()->route('generos.index')->with('destroy',' ');
    }
}
