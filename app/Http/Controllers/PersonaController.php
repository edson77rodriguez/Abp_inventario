<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaController extends Controller
{
    
    public function index()
    {
        $personas = Persona::all();
        return view('personas.index', compact('personas'));
    }
    public function create()
    {
        return view('personas.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'ap' => 'required',
            'am' => 'required',
            'telefono' => 'required',
        ]);
    
        Persona::create($validatedData);
    
        return redirect()->route('personas.index');
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $persona = Persona::find($id);
        return view('personas.edit', compact('persona'));
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'ap' => 'required',
            'am' => 'required',
            'telefono' => 'required',
        ]);
        $persona = Persona::find($id);
        $persona->update($request->all());

        return redirect()->route('personas.index');
    }
    public function destroy(string $id)
    {
        $persona = Persona::findOrFail($id);
        $persona->delete();

        return redirect()->route('personas.index');
    }
}
