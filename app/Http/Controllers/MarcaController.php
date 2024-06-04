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
        return view('marcas.index', compact('marcas'));
    }
    public function create()
    {
        $origenes = Origen::all();
        return view('marcas.create',compact('origenes'));
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
        return redirect()->route('marcas.index')->with('success', 'Marca creada exitosamente.');
    }
    
    public function show($id)
    {
        $marca = Marca::findOrFail($id);
        return view('marcas.show', compact('marca'));
    }
    public function edit(string $id)
    {
        // Obtener la marca a editar
        $marca = Marca::findOrFail($id);

        // Obtener todos los orígenes
        $origenes = Origen::all();

        // Retornar la vista con la marca y los orígenes
        return view('marcas.edit', compact('marca', 'origenes'));
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
        return redirect()->route('marcas.index')->with('success', 'Marca actualizada exitosamente.');
    }
    public function destroy(string $id)
    {
        $marca = Marca::findOrFail($id);
        $marca->delete();

        return redirect()->route('marcas.index');
    }
}