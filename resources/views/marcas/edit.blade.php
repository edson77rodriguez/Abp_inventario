<!-- resources/views/marcas/edit.blade.php -->
@extends('dashboard')
@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center font-weight-bold text-primary">
                Editar Marca
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
                            <label for="marca" class="form-label">Marca</label>
                            <input type="text" name="marca" id="marca" value="{{ old('marca', $marca->marca) }}" class="form-control @error('marca') is-invalid @enderror" required>
                            @error('marca')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="origen_id" class="form-label">Origen</label>
                            <select name="origen_id" id="origen_id" class="form-control @error('origen_id') is-invalid @enderror" required>
                                <option value="">Seleccione un origen</option>
                                @foreach ($origenes as $origen)
                                    <option value="{{ $origen->id }}" {{ $origen->id == old('origen_id', $marca->origen_id) ? 'selected' : '' }}>
                                        {{ $origen->pais }}
                                    </option>
                                @endforeach
                            </select>
                            @error('origen_id')
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
