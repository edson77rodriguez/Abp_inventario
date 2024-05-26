<!-- resources/views/marcas/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center font-weight-bold text-primary">
                Editar Persona
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('marcas.update', $marca->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Nombre</label>
                            <input type="text" name="descripcion" id="descripcion" value="{{ old('descripcion', $marca->descripcion) }}" class="form-control @error('descripcion') is-invalid @enderror" required>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="origen" class="form-label">Origen</label>
                            <input type="text" name="origen" id="origen" value="{{ old('origen', $marca->origen) }}" class="form-control @error('origen') is-invalid @enderror" required>
                            @error('origen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark me-3">Guardar</button>
                            <a href="{{ route('marcas.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
