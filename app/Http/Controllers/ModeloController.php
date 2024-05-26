<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modelo;

class ModeloController extends Controller
{
    public function index()
    {
        $modelos = Modelo::all();
        return view('modelos.index', compact('modelos'));
    }

    public function create()
    {
        return view('modelos.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
    
        Modelo::create($validatedData);
    
        return redirect()->route('modelos.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $modelo = Modelo::find($id);
        return view('modelos.edit', compact('modelo'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
        $modelo = Modelo::find($id);
        $modelo->update($request->all());

        return redirect()->route('modelos.index');
    }

    public function destroy(string $id)
    {
        $modelo = Modelo::findOrFail($id);
        $modelo->delete();

        return redirect()->route('modelos.index');
    }
}
