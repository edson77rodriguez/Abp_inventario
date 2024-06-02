<?php

namespace App\Http\Controllers;

use App\Models\AsignaCargo;
use App\Models\Empleado;
use App\Models\Cargo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AsignaCargoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AsignaCargoController extends Controller
{
    public function index(Request $request): View
    {
        $asignaCargos = AsignaCargo::paginate();

        return view('asigna-cargo.index', compact('asignaCargos'))
            ->with('i', ($request->input('page', 1) - 1) * $asignaCargos->perPage());
    }
    public function create(): View
    {
        $asignaCargo = new AsignaCargo();
        $empleados = Empleado::pluck('person_id','id');
        $cargos = Cargo::pluck('descripcion','id');

        return view('asigna-cargo.create', compact('asignaCargo','empleados','cargos'));
    }
    public function store(AsignaCargoRequest $request): RedirectResponse
    {
        AsignaCargo::create($request->validated());

        return Redirect::route('asigna-cargos.index')
            ->with('success', 'AsignaCargo created successfully.');
    }
    public function show($id): View
    {
       
    }
    public function edit($id): View
    {
        $asignaCargo = AsignaCargo::find($id);

        return view('asigna-cargo.edit', compact('asignaCargo'));
    }
    public function update(AsignaCargoRequest $request, AsignaCargo $asignaCargo): RedirectResponse
    {
        $asignaCargo->update($request->validated());

        return Redirect::route('asigna-cargos.index')
            ->with('success', 'AsignaCargo updated successfully');
    }
    public function destroy($id): RedirectResponse
    {
        AsignaCargo::find($id)->delete();

        return Redirect::route('asigna-cargos.index')
            ->with('success', 'AsignaCargo deleted successfully');
    }
}
