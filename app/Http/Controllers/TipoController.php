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
        return view('tipos.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
    
        Tipo::create($validatedData);
    
        return redirect()->route('tipos.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $tipo = Tipo::find($id);
        return view('tipos.edit', compact('tipo'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
        $tipo = Tipo::find($id);
        $tipo->update($request->all());

        return redirect()->route('tipos.index');
    }

    public function destroy(string $id)
    {
        $tipo = Tipo::findOrFail($id);

        $tipo->delete();

        return redirect()->route('tipos.index');
    }
}
