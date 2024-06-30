<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Tipo;

class HomeController extends Controller
{
    public function index()
    {
        $productos = Producto::inRandomOrder()->take(8)->get();
        $tipos = Tipo::all();
        
        return view('home', compact('tipos', 'productos'));
    }

    public function catalogo($tipoId)
    {
        $tipo = Tipo::findOrFail($tipoId);
        $productos = Producto::where('tipo_id', $tipoId)->get();
        return view('catalogo', compact('tipo', 'productos'));
    }

    public function detalle($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.detalle', compact('producto'));
    }
}