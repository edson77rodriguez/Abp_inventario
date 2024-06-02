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
            'nombre' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
            'ap_p' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
            'ap_m' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
            'id_genero' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
            'telefono' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
            'id_cargo' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',

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
            'nombre' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
            'ap_p' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
            'ap_m' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
            'id_genero' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
            'telefono' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
            'id_cargo' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
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
