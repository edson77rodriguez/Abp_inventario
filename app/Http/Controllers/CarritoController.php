<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Inventario;

class CarritoController extends Controller
{
    public function ver()
    {
        $carrito = session()->get('carrito', []);
        $haySuficienteStock = $this->verificarStockEnCarrito($carrito);
        return view('carrito.ver', compact('carrito', 'haySuficienteStock'));
    }

    public function agregar(Request $request, $id)
    {
        // Verificar si el producto existe en el inventario
        $inventario = Inventario::where('producto_id', $id)->first();

        if (!$inventario || $inventario->cantidad_stock <= 0) {
            return redirect()->back()->with('error', 'Producto no disponible en el inventario.');
        }

        // Verificar si ya existe el carrito en sesión
        $carrito = session()->get('carrito', []);

        // Verificar si el producto ya está en el carrito
        if (isset($carrito[$id])) {
            // Si el producto ya está en el carrito, incrementar la cantidad
            $carrito[$id]['cantidad']++;
        } else {
            // Si el producto no está en el carrito, agregarlo con cantidad inicial 1
            $producto = Producto::findOrFail($id);
            $carrito[$id] = [
                'producto' => $producto,
                'cantidad' => 1
            ];
        }

        // Actualizar la sesión del carrito
        session()->put('carrito', $carrito);

        // Redirigir a la vista de detalle del producto con mensaje de éxito
        return redirect()->route('productos.detalle', $id)->with('success', 'Producto añadido al carrito.');
    }

    public function actualizar(Request $request, $id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            // Acción para incrementar o decrementar la cantidad
            if ($request->action === 'increment') {
                $carrito[$id]['cantidad']++;
            } elseif ($request->action === 'decrement' && $carrito[$id]['cantidad'] > 1) {
                $carrito[$id]['cantidad']--;
            }
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.ver')->with('success', 'Carrito actualizado');
    }

    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.ver')->with('success', 'Producto eliminado del carrito');
    }

    private function verificarStockEnCarrito($carrito)
    {
        foreach ($carrito as $item) {
            $productoId = $item['producto']->id;
            $inventario = Inventario::where('producto_id', $productoId)->first();

            if (!$inventario || $inventario->cantidad_stock < $item['cantidad']) {
                return false;
            }
        }

        return true;
    }
}
