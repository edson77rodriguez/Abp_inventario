<?php

namespace App\Http\Controllers;

use App\Models\Origene;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\OrigeneRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class OrigeneController extends Controller
{
    public function index(Request $request): View
    {
        $origenes = Origene::paginate();

        return view('origene.index', compact('origenes'))
            ->with('i', ($request->input('page', 1) - 1) * $origenes->perPage());
    }

    public function create(): View
    {
        $origene = new Origene();

        return view('origene.create', compact('origene'));
    }
    public function store(OrigeneRequest $request): RedirectResponse
    {
        Origene::create($request->validated());

        return Redirect::route('origenes.index')
            ->with('success', 'Origene created successfully.');
    }
    public function show($id): View
    {
    
    }
    public function edit($id): View
    {
        $origene = Origene::find($id);

        return view('origene.edit', compact('origene'));
    }
    public function update(OrigeneRequest $request, Origene $origene): RedirectResponse
    {
        $origene->update($request->validated());

        return Redirect::route('origenes.index')
            ->with('success', 'Origene updated successfully');
    }
    public function destroy($id): RedirectResponse
    {
        Origene::find($id)->delete();

        return Redirect::route('origenes.index')
            ->with('success', 'Origene deleted successfully');
    }
}
