<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipopago;


class TipoPagosController extends Controller
{
    public function index()
    {
        $tipopagos = Tipopago::all();
        return view('tipopagos.index', compact('tipopagos'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tipo' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
    
        Tipopago::create($validatedData);
    
        return redirect()->route('tipopagos.index')->with('register',' ');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
     
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'tipo' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
        $tipopago = Tipopago::find($id);
        $tipopago->update($request->all());

        return redirect()->route('tipopagos.index')->with('modify',' ');
    }

    public function destroy(string $id)
    {
        $tipopago = Tipopago::findOrFail($id);
        $tipopago->delete();

        return redirect()->route('tipopagos.index')->with('destroy',' ');
    }
}
