<!-- resources/views/marcas/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center font-weight-bold text-primary">
                Editar Composicion
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('composiciones.update', $estilo->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="composicion" class="form-label">Composicion</label>
                            <input type="text" name="composicion" id="composicion" value="{{ old('composicion', $composicion->composicion) }}" class="form-control @error('composicion') is-invalid @enderror" required>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark me-3">Guardar</button>
                            <a href="{{ route('composiciones.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
