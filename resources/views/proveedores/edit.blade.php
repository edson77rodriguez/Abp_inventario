<!-- resources/views/marcas/edit.blade.php -->
@extends('dashboard')
@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center font-weight-bold text-primary">
                Editar el Modelo
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('proveedores.update', $proveedor->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="persona_id" class="form-label">Persona</label>
                            <select name="persona_id" id="persona_id" class="form-control" required>
                                <option value="">Seleccione una persona</option>
                                @foreach ($personas as $persona)
                                    <option value="{{ $persona->id }}" {{ $proveedor->persona_id == $persona->id ? 'selected' : '' }}>{{ $persona->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark me-3">Guardar</button>
                            <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
