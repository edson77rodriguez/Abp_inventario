<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo;

class TipoController extends Controller
{
    public function index()
    {
        $tipos = Tipo::all();
        return view('tipos.index', compact('tipos'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
    
        Tipo::create($validatedData);
    
        return redirect()->route('tipos.index')->with('register',' ');
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
        $tipo = Tipo::find($id);
        $tipo->update($request->all());

        return redirect()->route('tipos.index')->with('register',' ');
    }

    public function destroy(string $id)
    {
        $tipo = Tipo::findOrFail($id);

        $tipo->delete();

        return redirect()->route('tipos.index')->with('destroy',' ');
    }
}
