<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detalleventa;
use App\Models\Tipopago; // O App\Models\TipoPago si usas CamelCase en tu aplicación
use App\Models\Producto;
use App\Models\Venta;

class DetalleVentaController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        $ventas = Venta::all();
        $tipopagos = Tipopago::all();
        $detalleventas = Detalleventa::all();
        return view('detalleventas.index', compact('detalleventas','productos', 'ventas', 'tipopagos'));
    }

    public function create()
{
    $productos = Producto::all();
    $ventas = Venta::all();
    $tipopagos = Tipopago::all();

    return view('detalleventas.create', compact('productos', 'ventas', 'tipopagos'));
}


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'venta_id' => 'required|exists:ventas,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:0',
            'precio_unitario' => 'required|numeric|min:0',
            'tipopago_id' => 'required|exists:tipopagos,id',
        ]);

        Detalleventa::create($validatedData);
        return redirect()->route('detalleventas.index')->with('success', 'Inventario creado correctamente');
    }

    public function show(string $id)
    {
        $detalleventa = Detalleventa::findOrFail($id);
        return view('detalleventas.show', compact('detalleventa'));
    }

    public function edit(string $id)
    {
        $detalleventa = Detalleventa::findOrFail($id);
        $productos = Producto::all();
        $ventas = Venta::all();
        $tipopagos = Tipopago::all();

        return view('detalleventas.edit', compact('detalleventa', 'productos', 'ventas', 'tipopagos'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'venta_id' => 'required|exists:ventas,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:0',
            'precio_unitario' => 'required|numeric|min:0',
            'tipopago_id' => 'required',
        ]);

        $detalleventa = Detalleventa::findOrFail($id);
        $detalleventa->update($validatedData);

        return redirect()->route('detalleventas.index')->with('success', 'Inventario actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $detalleventa = Detalleventa::findOrFail($id);
        $detalleventa->delete();

        return redirect()->route('detalleventas.index')->with('success', 'Inventario eliminado correctamente');
    }
}
