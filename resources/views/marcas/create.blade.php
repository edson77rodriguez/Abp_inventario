<!-- resources/views/marcas/create.blade.php -->
@extends('dashboard')
@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="font-weight-bold text-primary">
                {{ __('Nueva Marca') }}
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('marcas.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="marca" class="form-label">Marca </label>
                            <input type="text" name="marca" id="marca" class="form-control" required>
                        </div>

                        <div>
                        <label for="origen_id">Origen:</label>
                            <select name="origen_id" id="origen_id" required>
                                <option value="">Seleccione un origen</option>
                                @foreach ($origenes as $origen)
                                    <option value="{{ $origen->id }}">{{ $origen->pais }}</option>
                                @endforeach
                            </select>
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
