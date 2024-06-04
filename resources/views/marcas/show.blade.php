@extends('dashboard')
@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="font-weight-bold text-primary">
                {{ __('Detalles de la Marca') }}
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Marca:</label>
                        <p>{{ $marca->marca }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Origen:</label>
                        <p>{{ $marca->origen->pais }}</p>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('marcas.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
