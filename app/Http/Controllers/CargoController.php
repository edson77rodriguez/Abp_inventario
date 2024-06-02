<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;

class CargoController extends Controller
{
    public function index()
    {
        $cargos = Cargo::all();
        return view('cargos.index', compact('cargos'));

    }
    public function create()
    {
        return view('cargos.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
    
        Cargo::create($validatedData);
    
        return redirect()->route('cargos.index');
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $cargo = Cargo::find($id);
        return view('cargos.edit', compact('cargo'));
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
        $cargo = Cargo::find($id);
        $cargo->update($request->all());

        return redirect()->route('cargos.index');
    }
    public function destroy(string $id)
    {
        $cargo = Cargo::findOrFail($id);

        $cargo->delete();

        return redirect()->route('cargos.index');
    }
}