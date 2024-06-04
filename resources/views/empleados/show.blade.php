@extends('dashboard')
@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="font-weight-bold text-primary">
                {{ __('Detalles del Empleado') }}
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Persona:</label>
                        <p>{{ $empleado->persona->nombre }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cargo:</label>
                        <p>{{ $empleado->cargo->descripcion }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha de Inicio:</label>
                        <p>{{ $empleado->fecha_inicio }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha de Fin:</label>
                        <p>{{ $empleado->fecha_fin ?? 'N/A' }}</p>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
