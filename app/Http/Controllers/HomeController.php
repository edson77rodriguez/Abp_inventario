<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Proveedor;




class HomeController extends Controller
{
    
    public function index()
    {
        $inventarios = Inventario::all();
        return view('home', compact('inventarios'));
    }
}
