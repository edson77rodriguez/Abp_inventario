<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('colors.index', compact('colors'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
    
        Color::create($validatedData);
    
        return redirect()->route('colors.index')->with('register', ' ');
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
            'descripcion' => 'required|string|min:1|max:255|regex:/^[a-zA-Z ñ]+$/',
        ]);
        $color = Color::find($id);
        $color->update($request->all());

        return redirect()->route('colors.index')->with('modify', ' ');
    }

    public function destroy(string $id)
    {
        $color = Color::findOrFail($id);
        $color->delete();

        return redirect()->route('colors.index')->with('destroy', ' ');
    }
}
