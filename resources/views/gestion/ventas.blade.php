@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Historial de Ventas</h2>
    <div class="row">
        @foreach ($dventas as $dventa)
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h3>Venta ID: {{ $dventa->venta->id }}</h3>
                        <p><strong>Fecha de Venta:</strong> {{ $dventa->venta->fecha_venta }}</p>
                        <p><strong>Empleado:</strong> {{ $dventa->venta->empleado->persona->nombre }}</p>
                        <p><strong>Producto:</strong> {{ $dventa->producto->tipo->descripcion }}</p>
                        <p><strong>Marca:</strong> {{ $dventa->producto->marca->marca }}</p>
                        <p><strong>Talla:</strong> {{ $dventa->producto->talla->descripcion }}</p>
                        <p><strong>Cantidad:</strong> {{ $dventa->cantidad }}</p>
                        <p><strong>Ganancia:</strong> {{ $dventa->venta->ganancia }}</p>
                        <p><strong>Tipo de Pago:</strong> {{ $dventa->tipopago->descripcion }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
