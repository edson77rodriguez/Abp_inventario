<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Persona;
use App\Models\Cargo;
class EmpleadoController extends Controller
{
   
    public function index()
    {
        $personas = Persona::all();
        $cargos = Cargo::all();
        $empleados = Empleado::all();
        return view('empleados.index', compact('empleados','personas', 'cargos'));
    }

    public function create()
    {
       
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'cargo_id' => 'required|exists:cargos,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        Empleado::create($validatedData);

        return redirect()->route('empleados.index')->with('register', ' ');
    }
    public function show($id)
    {
       
    }
    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'cargo_id' => 'required|exists:cargos,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $empleado = Empleado::findOrFail($id);
        $empleado->update($validatedData);

        return redirect()->route('empleados.index')->with('modify', 'Empleado actualizado exitosamente.');
    }
    public function destroy(string $id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();

        return redirect()->route('empleados.index')->with('destroy', ' ');
    }
}
