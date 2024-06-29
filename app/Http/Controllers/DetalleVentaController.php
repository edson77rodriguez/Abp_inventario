<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detalleventa;
use App\Models\Tipopago; // O App\Models\TipoPago si usas CamelCase en tu aplicación
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Inventario;


class DetalleVentaController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        $ventas = Venta::all();
        $tipopagos = Tipopago::all();
        $detalleventas = Detalleventa::all();
        $inventarios = Inventario::all();
        return view('detalleventas.index', compact('detalleventas','productos', 'ventas', 'tipopagos','inventarios'));
    }

    public function create()
{
    
}


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'venta_id' => 'required|exists:ventas,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:0',
            'inventario_id' => 'required|exists:inventarios,id',
            'tipopago_id' => 'required|exists:tipo_pagos,id', /// el cambio aqui fue la variable de tipopagos ->tipo_pagos
        ]);

        Detalleventa::create($validatedData);
        return redirect()->route('detalleventas.index')->with('register', ' ');
    }

    public function show(string $id)
    {
       
    }

    public function edit(string $id)
    {

    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'venta_id' => 'required|exists:ventas,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:0',
            'inventario_id' => 'required|exists:inventarios,id',
            'tipopago_id' => 'required',
        ]);

        $detalleventa = Detalleventa::findOrFail($id);
        $detalleventa->update($validatedData);

        return redirect()->route('detalleventas.index')->with('register', 'Inventario actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $detalleventa = Detalleventa::findOrFail($id);
        $detalleventa->delete();

        return redirect()->route('detalleventas.index')->with('destroy', 'Inventario eliminado correctamente');
    }
}
