<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Inventario;
use App\Models\Venta;
use App\Models\Detalleventa;
use App\Models\Empleado;
use Carbon\Carbon;
use App\Models\Tipopago;


class CarritoController extends Controller
{
    public function ver()
    {
        $carrito = session()->get('carrito', []);
        $haySuficienteStock = $this->verificarStockEnCarrito($carrito);
        $empleados = Empleado::all(); // Obtener todos los empleados
        $tipopagos = Tipopago::all(); // Obtener todos los tipos de pago
        return view('carrito.ver', compact('carrito', 'haySuficienteStock', 'empleados','tipopagos'));
    }

    public function agregar(Request $request, $id)
    {
        // Verificar si el producto existe en el inventario
        $inventario = Inventario::where('producto_id', $id)->first();
    
        if (!$inventario || $inventario->cantidad_stock <= 0) {
            return redirect()->back()->with('error', 'Producto no disponible en el inventario.');
        }
    
        // Verificar si el producto existe antes de acceder a sus propiedades
        $producto = Producto::find($id);
        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }
    
        $carrito = session()->get('carrito', []);
    
        if (isset($carrito[$id])) {
            // Si el producto ya está en el carrito, incrementar la cantidad
            $carrito[$id]['cantidad']++;
        } else {
            // Si el producto no está en el carrito, agregarlo con su precio de venta
            $carrito[$id] = [
                'producto' => $producto,
                'cantidad' => 1,
                'precio_venta' => $inventario->precio_venta, // Agregar el precio de venta del inventario
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
            // Obtener el producto y su inventario asociado
            $productoId = $carrito[$id]['producto']->id;
            $inventario = Inventario::where('producto_id', $productoId)->first();
    
            if (!$inventario || $inventario->cantidad_stock <= 0 || $request->cantidad > $inventario->cantidad_stock) {
                return redirect()->route('carrito.ver')->with('error', 'No hay suficiente stock disponible para este producto.');
            }
    
            // Actualizar la cantidad en el carrito y recalcular el subtotal con el precio de venta
            $carrito[$id]['cantidad'] = $request->cantidad;
            $carrito[$id]['subtotal'] = $request->cantidad * $inventario->precio_venta; // Calcular subtotal con precio de venta
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

    public function checkout()
    {
        $carrito = session()->get('carrito', []);
        $empleados = Empleado::all(); // Obtener todos los empleados
        $tipopagos = Tipopago::all(); // Obtener todos los tipos de pago

        return view('checkout', compact('carrito', 'empleados','tipopagos'));
    }

    public function procesarPago(Request $request)
{
    $carrito = session()->get('carrito', []);
    $empleado_id = $request->input('empleado_id'); // Obtener el ID del empleado desde el formulario
    $tipopago_id = $request->input('tipopago_id'); // Obtener el ID del tipo de pago desde el formulario

    foreach ($carrito as $id => $detalle) {
        $inventario = Inventario::where('producto_id', $id)->first();

        if ($inventario) {
            // Crear la venta
            $venta = Venta::create([
                'fecha_venta' => Carbon::now()->toDateTimeString(),
                'empleado_id' => $empleado_id,
                'producto_id' => $id,
                'cantidad' => $detalle['cantidad'], // Agregar la cantidad
                'inventario_id' => $inventario->id,
                'ganancia' => $detalle['precio_venta']  * $detalle['cantidad'], // Calcular ganancia
            ]);

            // Crear el detalle de la venta
            Detalleventa::create([
                'venta_id' => $venta->id,
                'producto_id' => $id,
                'cantidad' => $detalle['cantidad'],
                'inventario_id' => $inventario->id,
                'tipopago_id' =>  $tipopago_id, // Puedes ajustar el tipo de pago según sea necesario
            ]);

            // Decrementar la cantidad en stock
            $inventario->cantidad_stock -= $detalle['cantidad'];
            $inventario->save();
        }
    }

    // Vaciar el carrito
    session()->forget('carrito');

    return redirect()->route('checkout')->with('success', 'Pago procesado exitosamente. Gracias por su compra.');
}

}
