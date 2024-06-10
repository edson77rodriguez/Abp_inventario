<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Producto;

class InventarioController extends Controller
{
    public function index()
    {
        $inventarios = Inventario::all();
        $productos = Producto::all();
        return view('inventarios.index', compact('inventarios','productos'));
    }

    public function create()
    {
    $productos = Producto::all();
    return view('inventarios.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad_stock' => 'required|integer|min:0',
            'fecha_ingreso' => 'required|date',
        ]);

        Inventario::create($validatedData);
        return redirect()->route('inventarios.index')->with('register', ' ');
    }

    public function show(string $id)
    {
        $inventario = Inventario::findOrFail($id);
        return view('inventarios.show', compact('inventario'));
    }

    public function edit(string $id)
    {
        $inventario = Inventario::findOrFail($id);
        $productos = Producto::all();
        return view('inventarios.edit', compact('inventario', 'productos'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad_stock' => 'required|integer|min:0',
            'fecha_ingreso' => 'required|date',
        ]);

        $inventario = Inventario::findOrFail($id);
        $inventario->update($validatedData);

        return redirect()->route('inventarios.index')->with('register', ' ');
    }

    public function destroy(string $id)
    {
        $inventario = Inventario::findOrFail($id);
        $inventario->delete();
      
        return redirect()->route('inventarios.index')->with('destroy', ' ');
    }
}
