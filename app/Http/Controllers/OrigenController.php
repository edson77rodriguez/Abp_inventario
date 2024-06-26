<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Origen;


class OrigenController extends Controller
{
    public function index()
    {
        $origenes = Origen::all();
        return view('origenes.index', compact('origenes'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pais' => 'required',
        ]);
    
        Origen::create($validatedData);
    
        return redirect()->route('origenes.index')->with('register',' ');
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
            'pais' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
        $origen = Origen::find($id);
        $origen->update($request->all());

        return redirect()->route('origenes.index')->with('modify',' ');
    }

    public function destroy(string $id)
    {
        $origen = Origen::findOrFail($id);
        $origen->delete();

        return redirect()->route('origenes.index')->with('destroy',' ');
    }
}
