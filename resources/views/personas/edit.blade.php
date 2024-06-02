<!-- resources/views/marcas/edit.blade.php -->
@extends('dashboard')
@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center font-weight-bold text-primary">
                Editar el Persona
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('personas.update', $persona->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $persona->nombre) }}" class="form-control @error('nombre') is-invalid @enderror" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ap_p" class="form-label">Apellido Paterno</label>
                            <input type="text" name="ap_p" id="ap_p" value="{{ old('ap_p', $persona->ap_p) }}" class="form-control @error('ap_p') is-invalid @enderror" required>
                            @error('ap_p')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ap_m" class="form-label">Apellido Materno</label>
                            <input type="text" name="ap_m" id="ap_m" value="{{ old('ap_m', $persona->ap_m) }}" class="form-control @error('ap_m') is-invalid @enderror" required>
                            @error('ap_m')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_genero" class="form-label">Genero</label>
                            <input type="text" name="id_genero" id="id_genero" value="{{ old('id_genero', $persona->id_genero) }}" class="form-control @error('id_genero') is-invalid @enderror" required>
                            @error('id_genero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Telefono</label>
                            <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $persona->telefono) }}" class="form-control @error('telefono') is-invalid @enderror" required>
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_cargo" class="form-label">Nombre</label>
                            <input type="text" name="id_cargo" id="id_cargo" value="{{ old('id_cargo', $persona->id_cargo) }}" class="form-control @error('id_cargo') is-invalid @enderror" required>
                            @error('id_cargo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark me-3">Guardar</button>
                            <a href="{{ route('personas.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
