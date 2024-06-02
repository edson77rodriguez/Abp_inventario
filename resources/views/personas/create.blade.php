<!-- resources/views/marcas/create.blade.php -->
@extends('dashboard')
@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="font-weight-bold text-primary">
                {{ __('Nueva Persona') }}
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('personas.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="ap_p" class="form-label">Apellido Paterno</label>
                            <input type="text" name="ap_p" id="ap_p" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="ap_m" class="form-label">Apellido Materno</label>
                            <input type="text" name="ap_m" id="ap_m" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_genero" class="form-label">Genero</label>
                            <input type="text" name="id_genero" id="id_genero" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Telefono</label>
                            <input type="tel" name="telefono" id="telefono" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_cargo" class="form-label">Cargo</label>
                            <input type="text" name="id_cargo" id="id_cargo" class="form-control" required>
                        </div>


                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark me-5 text-center">Guardar</button>
                            <a href="{{ route('personas.index') }}" class="btn btn-secondary me-3">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
