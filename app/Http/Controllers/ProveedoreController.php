<?php

namespace App\Http\Controllers;

use App\Models\Proveedore;
use App\Models\Persona;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ProveedoreRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProveedoreController extends Controller
{
    public function index(Request $request): View
    {
        $proveedores = Proveedore::paginate();

        return view('proveedore.index', compact('proveedores'))
            ->with('i', ($request->input('page', 1) - 1) * $proveedores->perPage());
    }
    public function create(): View
    {
        $proveedore = new Proveedore();
        $personas = Persona::pluck('nombre','id');
        return view('proveedore.create', compact('proveedore','personas'));
    }
    public function store(ProveedoreRequest $request): RedirectResponse
    {
        Proveedore::create($request->validated());

        return Redirect::route('proveedores.index')
            ->with('success', 'Proveedore created successfully.');
    }
    public function show($id): View
    {
       ///
    }
    public function edit($id): View
    {
        $proveedore = Proveedore::find($id);
        $personas = Persona::pluck('nombre','id');
        return view('proveedore.edit', compact('proveedore'));
    }

    public function update(ProveedoreRequest $request, Proveedore $proveedore): RedirectResponse
    {
        $proveedore->update($request->validated());

        return Redirect::route('proveedores.index')
            ->with('success', 'Proveedore updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Proveedore::find($id)->delete();

        return Redirect::route('proveedores.index')
            ->with('success', 'Proveedore deleted successfully');
    }
}
