@extends('dashboard')

@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center font-weight-bold text-primary">
                Detalles de la Venta
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Información de la Venta</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Venta ID:</strong> {{ $detalleventa->venta->fecha_venta ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Producto:</strong> 
                            {{ $detalleventa->producto->tipo->descripcion ?? 'N/A' }} 
                            {{ $detalleventa->producto->modelo->descripcion ?? 'N/A' }} 
                            {{ $detalleventa->producto->marca->marca ?? 'N/A' }}
                        </li>
                        <li class="list-group-item"><strong>Cantidad:</strong> {{ $detalleventa->cantidad ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Precio Unitario:</strong> {{ $detalleventa->precio_unitario ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Tipo de Pago:</strong> {{ $detalleventa->tipopago->tipo ?? 'N/A' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="d-flex justify-content-end">
                <a href="{{ route('detalleventas.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
