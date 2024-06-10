<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estilo;

class EstiloController extends Controller
{
    public function index()
    {
        $estilos = Estilo::all();
        return view('estilos.index', compact('estilos'));

    }
    public function create()
    {
        return view('estilos.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'estilo' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
    
        Estilo::create($validatedData);
    
        return redirect()->route('estilos.index')->with('register',' ');
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $estilo = Estilo::find($id);
        return view('estilos.edit', compact('estilo'));
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'estilo' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
        $estilo = Estilo::find($id);
        $estilo->update($request->all());

        return redirect()->route('estilos.index')->with('register',' ');
    }
    public function destroy(string $id)
    {
        $estilo = Estilo::findOrFail($id);

        $estilo->delete();

        return redirect()->route('estilos.index')->with('destroy',' ');;
    }
}