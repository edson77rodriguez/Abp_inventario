<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Tipo;
use App\Models\Marca;
use App\Models\Talla;
use App\Models\Genero;
use App\Models\Modelo;
use App\Models\Color;
use App\Models\Composicion;
use App\Models\Estilo;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $data = $this->getRelatedData();
        $data['productos'] = Producto::all();
        return view('productos.index', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tipo_id' => 'required|exists:tipos,id',
            'marca_id' => 'required|exists:marcas,id',
            'talla_id' => 'required|exists:tallas,id',
            'genero_id' => 'required|exists:generos,id',
            'modelo_id' => 'required|exists:modelos,id',
            'color_id' => 'required|exists:colors,id',
            'composicion_id' => 'required|exists:composicions,id',
            'estilo_id' => 'required|exists:estilos,id',
            'precio_compra' => 'required|numeric|min:0',
            'proveedor_id' => 'required|exists:proveedors,id',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('imagenes', 'public');
            $validatedData['imagen'] = $path;
        }

        Producto::create($validatedData);

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit($id)
    {
        $data = $this->getRelatedData();
        $data['producto'] = Producto::findOrFail($id);
        return view('productos.index', $data);
    }
    

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tipo_id' => 'required|exists:tipos,id',
            'marca_id' => 'required|exists:marcas,id',
            'talla_id' => 'required|exists:tallas,id',
            'genero_id' => 'required|exists:generos,id',
            'modelo_id' => 'required|exists:modelos,id',
            'color_id' => 'required|exists:colors,id',
            'composicion_id' => 'required|exists:composicions,id',
            'estilo_id' => 'required|exists:estilos,id',
            'precio_compra' => 'required|numeric|min:0',
            'proveedor_id' => 'required|exists:proveedors,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $producto = Producto::findOrFail($id);

        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $path = $request->file('imagen')->store('imagenes', 'public');
            $validatedData['imagen'] = $path;
        }

        $producto->update($validatedData);

        return redirect()->route('productos.index')->with('register', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        return redirect()->route('productos.index')->with('destroy', 'Producto eliminado exitosamente.');
    }

    private function getRelatedData()
    {
        return [
            'tipos' => Tipo::all(),
            'marcas' => Marca::all(),
            'tallas' => Talla::all(),
            'generos' => Genero::all(),
            'modelos' => Modelo::all(),
            'colors' => Color::all(),
            'composiciones' => Composicion::all(),
            'estilos' => Estilo::all(),
            'proveedores' => Proveedor::all(),
        ];
    }
}