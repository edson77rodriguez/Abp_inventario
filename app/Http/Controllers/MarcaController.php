<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Origen;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::all();
        $origenes = Origen::all();
        return view('marcas.index', compact('marcas','origenes'));
    }
    public function create()
    {
      
    }
    public function store(Request $request)
    {
        // Validar los datos y asignarlos a la variable $validatedData
        $validatedData = $request->validate([
            'marca' => 'required|string|max:255',
            'origen_id' => 'required|exists:origens,id'
        ]);
    
        // Crear una nueva marca con los datos validados
        Marca::create($validatedData);
    
        // Redirigir con un mensaje de éxito (opcional)
        return redirect()->route('marcas.index')->with('register', 'Marca creada exitosamente.');
    }
    
    public function show($id)
    {
       
    }
    public function edit(string $id)
    {
    
    }
    public function update(Request $request, string $id)
    {
        // Validar los datos
        $request->validate([
            'marca' => 'required|string|max:255',
            'origen_id' => 'required|exists:origens,id'
        ]);

        // Obtener la marca a actualizar
        $marca = Marca::findOrFail($id);

        // Actualizar la marca con los nuevos datos
        $marca->update($request->all());

        // Redirigir con un mensaje de éxito
        return redirect()->route('marcas.index')->with('register', 'Marca actualizada exitosamente.');
    }
    public function destroy(string $id)
    {
        $marca = Marca::findOrFail($id);
        $marca->delete();

        return redirect()->route('marcas.index')->with('destroy',' ');
    }
}
