@extends('dashboard')
@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center font-weight-bold text-primary">
                Detalles del Producto
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Información del Producto</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Tipo:</strong> {{ $producto->tipo->descripcion }}</li>
                        <li class="list-group-item"><strong>Marca:</strong> {{ $producto->marca->marca }}</li>
                        <!-- Repite el mismo patrón para los demás campos -->
                        <li class="list-group-item"><strong>Cantidad:</strong> {{ $producto->cantidad }}</li>
                        <li class="list-group-item"><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</li>
                        <li class="list-group-item"><strong>Fecha de Registro:</strong> {{ $producto->fecha_reg }}</li>
                        <li class="list-group-item"><strong>Hora:</strong> {{ $producto->hora }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="d-flex justify-content-end">
                <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
