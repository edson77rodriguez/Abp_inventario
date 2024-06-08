@extends('dashboard')

@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center font-weight-bold text-primary">
                Detalles del Inventario
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Información del Inventario</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Producto:</strong> {{ $inventario->producto->tipo->descripcion }} {{ $inventario->producto->modelo->descripcion }} {{ $inventario->producto->marca->marca }}</li>
                        <li class="list-group-item"><strong>Cantidad en Stock:</strong> {{ $inventario->cantidad_stock }}</li>
                        <li class="list-group-item"><strong>Fecha de Ingreso:</strong> {{ $inventario->fecha_ingreso }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="d-flex justify-content-end">
                <a href="{{ route('inventarios.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
