<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Inventario;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::all();
        $empleados = Empleado::all();
        $productos = Producto::all();
        return view('ventas.index', compact('ventas', 'empleados', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'fecha_venta' => 'required|date',
            'empleado_id' => 'required|exists:empleados,id',
            'cantidad' => 'required|numeric|min:0',
        ]);

        $producto = Producto::findOrFail($request->producto_id);
        $inventario = Inventario::where('producto_id', $producto->id)->firstOrFail();
        $total = $request->cantidad * $inventario->precio_venta;

        $venta = new Venta();
        $venta->producto_id = $request->producto_id;
        $venta->fecha_venta = $request->fecha_venta;
        $venta->empleado_id = $request->empleado_id;
        $venta->cantidad = $request->cantidad;
        $venta->ganancia = $total;
        $venta->inventario_id = $inventario->id; // Proporcionar el valor de inventario_id

        $venta->save();

        return redirect()->route('ventas.index')->with('register', 'Venta registrada correctamente');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_venta' => 'required|date',
            'empleado_id' => 'required|exists:empleados,id',
            'cantidad' => 'required|numeric|min:0',
        ]);

        $venta = Venta::findOrFail($id);
        $producto = Producto::findOrFail($venta->producto_id);
        $inventario = Inventario::where('producto_id', $producto->id)->firstOrFail();
        $total = $request->cantidad * $inventario->precio_venta;

        $venta->fecha_venta = $request->fecha_venta;
        $venta->empleado_id = $request->empleado_id;
        $venta->cantidad = $request->cantidad;
        $venta->ganancia = $total;
        $venta->save();

        return redirect()->route('ventas.index')->with('register', 'Venta actualizada correctamente');
    }

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();

        return redirect()->route('ventas.index')->with('destroy', 'Venta eliminada correctamente');
    }
}