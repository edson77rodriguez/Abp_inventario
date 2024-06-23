<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Composicion;

class ComposicionController extends Controller
{
    public function index()
    {
        $composiciones = Composicion::all();
        return view('composiciones.index', compact('composiciones'));

    }
    public function create()
    {
       
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'composicion' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
    
        Composicion::create($validatedData);
    
        return redirect()->route('composiciones.index')->with('register',' ');
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
            'composicion' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
        $composicion = Composicion::find($id);
        $composicion->update($request->all());

        return redirect()->route('composiciones.index')->with('register',' ');
    }
    public function destroy(string $id)
    {
        $composicion = Composicion::findOrFail($id);

        $composicion->delete();

        return redirect()->route('composiciones.index')->with('destroy',' ');
    }
}
