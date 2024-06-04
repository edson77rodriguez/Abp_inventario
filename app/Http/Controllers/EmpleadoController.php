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
        $empleados = Empleado::all();
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        $personas = Persona::all();
        $cargos = Cargo::all();
        return view('empleados.create', compact('personas', 'cargos'));
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

        return redirect()->route('empleados.index')->with('success', 'Empleado creado exitosamente.');
    }
    public function show($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleados.show', compact('empleado'));
    }
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        $personas = Persona::all();
        $cargos = Cargo::all();
        return view('empleados.edit', compact('empleado', 'personas', 'cargos'));
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

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente.');
    }
    public function destroy(string $id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();

        return redirect()->route('empleados.index');
    }
}
