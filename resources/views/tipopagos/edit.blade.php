<!-- resources/views/marcas/edit.blade.php -->
@extends('dashboard')
@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center font-weight-bold text-primary">
                Editar Tipo pago
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('tipopagos.update', $tipopago->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo pago</label>
                            <input type="text" name="tipo" id="tipo" value="{{ old('tipo', $tipopago->tipo) }}" class="form-control @error('tipo') is-invalid @enderror" required>
                            @error('tipo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark me-3">Guardar</button>
                            <a href="{{ route('tipopagos.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
