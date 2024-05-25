<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
class MarcaController extends Controller
{
   
    public function index()
    {
        $marcas = Marca::all();
        return view('marcas.index', compact('marcas'));

    }
    public function create()
    {
        return view('marcas.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
            'origen' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
    
        
    
        Marca::create($validatedData);
    
        return redirect()->route('marcas.index');
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $marca = Marca::find($id);
        return view('marcas.edit', compact('marca'));
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
            'origen' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
        $marca = Marca::find($id);
        $marca->update($request->all());

        return redirect()->route('marcas.index');
    }
    public function destroy(string $id)
    {
        $marca = Marca::findOrFail($id);

        $marca->delete();

        return redirect()->route('marcas.index');
    }
}
