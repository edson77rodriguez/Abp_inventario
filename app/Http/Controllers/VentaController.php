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

        // Verifica si hay suficiente stock
        if ($inventario->cantidad_stock < $request->cantidad) {
            return redirect()->route('ventas.index')->with('error', 'No hay suficiente stock en el inventario');
        }

        $total = $request->cantidad * $inventario->precio_venta;

        $venta = new Venta();
        $venta->producto_id = $request->producto_id;
        $venta->fecha_venta = $request->fecha_venta;
        $venta->empleado_id = $request->empleado_id;
        $venta->cantidad = $request->cantidad;
        $venta->ganancia = $total;
        $venta->inventario_id = $inventario->id;

        $venta->save();

        // Decrementar la cantidad en el inventario
        $inventario->cantidad_stock -= $request->cantidad;
        $inventario->save();

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

        // Restaurar la cantidad anterior en el inventario
        $inventario->cantidad_stock += $venta->cantidad;
        
        // Verifica si hay suficiente stock para la nueva cantidad
        if ($inventario->cantidad_stock < $request->cantidad) {
            return redirect()->route('ventas.index')->with('error', 'No hay suficiente stock en el inventario');
        }

        $venta->fecha_venta = $request->fecha_venta;
        $venta->empleado_id = $request->empleado_id;
        $venta->cantidad = $request->cantidad;
        $venta->ganancia = $total;
        $venta->save();

        // Decrementar la nueva cantidad en el inventario
        $inventario->cantidad_stock -= $request->cantidad;
        $inventario->save();

        return redirect()->route('ventas.index')->with('register', 'Venta actualizada correctamente');
    }


    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);

        // Restaurar la cantidad en el inventario
        $inventario = Inventario::where('producto_id', $venta->producto_id)->firstOrFail();
        $inventario->cantidad_stock += $venta->cantidad;
        $inventario->save();

        $venta->delete();

        return redirect()->route('ventas.index')->with('destroy', 'Venta eliminada correctamente');
    }
}