<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Persona;
class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores =Proveedor::all();
        $personas=Persona::all();
        return view('proveedores.index',compact('proveedores','personas'));

    }

    public function create()
    {
        $personas=Persona::all();
        return view('proveedores.create',compact('personas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'persona_id'=>'required',
        ]);

        Proveedor::create ($validatedData);
        return redirect()->route('proveedores.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $proveedor=Proveedor::findOrFail($id);
        $personas=Persona::all();
        return view('proveedores.edit',compact('proveedor','personas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'persona_id' => 'required|exists:personas,id',
        ]);

        $proveedor=Proveedor::findOrFail($id);
        $proveedor->update($validatedData);

        return redirect()->route('proveedores.index')->with('succes','Quedo pa');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $proveedors=Proveedor::findOrFail($id);
      $proveedors->delete();
      
      return redirect()->route('proveedores.index');
    }
}
