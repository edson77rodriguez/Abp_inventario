<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Talla;

class TallaController extends Controller
{
    public function index()
    {
        $tallas = Talla::all();
        return view('tallas.index', compact('tallas'));
    }

    public function create()
    {
        return view('tallas.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required|string',
        ]);

        Talla::create($validatedData);

        return redirect()->route('tallas.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $talla = Talla::find($id);
        return view('tallas.edit', compact('talla'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
        $talla = Talla::find($id);
        $talla->update($request->all());

        return redirect()->route('tallas.index');
    }

    public function destroy(string $id)
    {
        $talla = Talla::findOrFail($id);

        $talla->delete();

        return redirect()->route('tallas.index');
    }
}
