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

class ProductoController extends Controller
{
    public function index()
    {
        $tipos = Tipo::all();
        $marcas = Marca::all();
        $tallas = Talla::all();
        $generos = Genero::all();
        $modelos = Modelo::all();
        $colors = Color::all();
        $composiciones = Composicion::all();
        $estilos = Estilo::all();
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        return view('productos.index', compact('productos','tipos', 'marcas', 'tallas', 'generos', 'modelos', 'colors', 'composiciones', 'estilos','proveedores'));
    }

    public function create()
    {
        $tipos = Tipo::all();
        $marcas = Marca::all();
        $tallas = Talla::all();
        $generos = Genero::all();
        $modelos = Modelo::all();
        $colors = Color::all();
        $composiciones = Composicion::all();
        $estilos = Estilo::all();
        $proveedores = Proveedor::all();

        return view('productos.create', compact('tipos', 'marcas', 'tallas', 'generos', 'modelos', 'colors', 'composiciones', 'estilos','proveedores'));
    }

    public function store(Request $request)
{
    $validatedData=$request->validate([
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
        
    ]);

    Producto::create($validatedData);

    return redirect()->route('productos.index')->with('register', 'Producto creado exitosamente.');
}

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $tipos = Tipo::all();
        $marcas = Marca::all();
        $tallas = Talla::all();
        $generos = Genero::all();
        $modelos = Modelo::all();
        $colors = Color::all();
        $composiciones = Composicion::all();
        $estilos = Estilo::all();
        $proveedores = Proveedor::all();

        return view('productos.edit', compact('producto', 'tipos', 'marcas', 'tallas', 'generos', 'modelos', 'colors', 'composiciones', 'estilos','proveedores'));
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
    ]);

    $producto = Producto::findOrFail($id);
    $producto->update($validatedData);

    return redirect()->route('productos.index')->with('register', 'Producto actualizado exitosamente.');
}

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('destroy', 'Producto eliminado exitosamente.');
    }
}
