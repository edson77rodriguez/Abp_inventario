@extends('dashboard')

@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center font-weight-bold text-primary">
                Detalles del Venta
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Información de la venta</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Fecha de venta:</strong> {{ $venta->fecha_venta }}</li>
                        <li class="list-group-item"><strong>Empleado:</strong> {{ $venta->empleado->persona->nombre }} {{ $venta->empleado->persona->ap }} {{ $venta->empleado->persona->am }}</li>
                        <li class="list-group-item"><strong>Total venta:</strong> {{ $venta->ganancia }}</li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="d-flex justify-content-end">
                <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
