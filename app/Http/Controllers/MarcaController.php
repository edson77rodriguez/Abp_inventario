<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Origene;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MarcaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MarcaController extends Controller
{
    public function index(Request $request): View
    {
        $marcas = Marca::paginate();

        return view('marca.index', compact('marcas'))
            ->with('i', ($request->input('page', 1) - 1) * $marcas->perPage());
    }

    public function create(): View
    {
        $marca = new Marca();
        $origenes = Origene::pluck('pais','id');
        return view('marca.create', compact('marca','origenes'));
    }

    public function store(MarcaRequest $request): RedirectResponse
    {
        Marca::create($request->validated());
        
        return Redirect::route('marcas.index')
            ->with('success', 'Marca created successfully.');
    }

    public function show($id): View
    {
        
    }

    public function edit($id): View
    {
        $marca = Marca::find($id);
        $origenes = Origene::pluck('pais','id');

        return view('marca.edit', compact('marca','origenes'));
    }

    public function update(MarcaRequest $request, Marca $marca): RedirectResponse
    {
        $marca->update($request->validated());

        return Redirect::route('marcas.index')
            ->with('success', 'Marca updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Marca::find($id)->delete();

        return Redirect::route('marcas.index')
            ->with('success', 'Marca deleted successfully');
    }
}
