<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Empleado;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::all();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
    $empleados = Empleado::all();
    return view('ventas.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fecha_venta' => 'required|date',
            'empleado_id' => 'required|exists:productos,id',
            'ganancia' => 'required|numeric|min:0',
          
        ]);

        Venta::create($validatedData);
        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente');
    }

    public function show(string $id)
    {
        $venta = Venta::findOrFail($id);
        return view('ventas.show', compact('venta'));
    }

    public function edit(string $id)
    {
        $venta = Venta::findOrFail($id);
        $empleados = Empleado::all();
        return view('ventas.edit', compact('venta', 'empleados'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
           'fecha_venta' => 'required|date',
            'empleado_id' => 'required|exists:productos,id',
            'ganancia' => 'required|numeric|min:0',
        ]);

        $venta = Venta::findOrFail($id);
        $venta->update($validatedData);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente');
    }

    public function destroy(string $id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();
      
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente');
    }
}
