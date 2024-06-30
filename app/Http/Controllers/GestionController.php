<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Venta;
use App\Models\Proveedor;
use App\Models\Informe;
use App\Models\Detalleventa;

use App\Models\Configuracion;

class GestionController extends Controller
{
    public function inventario()
    {
        // Lógica para gestionar el inventario
        $inventarios=inventario::all();
        return view('gestion.inventario',compact('inventarios'));
    }

    public function ventas()
    {
        // Lógica para gestionar las ventas
        $dventas = Detalleventa::all();
        return view('gestion.ventas', compact('dventas'));
    }

    public function proveedores()
    {
        // Lógica para gestionar los proveedores
        $proveedores = Proveedor::all();
        return view('gestion.proveedores', compact('proveedores'));
    }

    public function informes()
    {
        // Lógica para generar informes
        $ventas = Venta::all();
        return view('gestion.informes', compact('ventas'));
    }

    public function configuracion()
    {
        // Lógica para configuración del sistema
        $configuracion = Configuracion::all();
        return view('gestion.configuracion', compact('configuracion'));
    }
}
