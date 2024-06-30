@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Inventario de Productos</h2>
    <div class="row">
        @foreach ($inventarios as $inventario)
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h3>{{ $inventario->producto->tipo->descripcion }}</h3>
                        <img src="{{ asset('storage/' . $inventario->producto->imagen) }}" class="img-fluid mb-3" alt="{{ $inventario->producto->descripcion }}">
                        <p><strong>Descripción:</strong> {{ $inventario->producto->descripcion }}</p>
                        <p><strong>Marca:</strong> {{ $inventario->producto->marca->marca }}</p>
                        <p><strong>Talla:</strong> {{ $inventario->producto->talla->descripcion }}</p>
                        <p><strong>Género:</strong> {{ $inventario->producto->genero->descripcion }}</p>
                        <p><strong>Modelo:</strong> {{ $inventario->producto->modelo->descripcion }}</p>
                        <p><strong>Color:</strong> {{ $inventario->producto->color->descripcion }}</p>
                        <p><strong>Composición:</strong> {{ $inventario->producto->composicion->composicion }}</p>
                        <p><strong>Estilo:</strong> {{ $inventario->producto->estilo->estilo }}</p>
                        <p><strong>Precio Venta:</strong> {{ $inventario->precio_venta }}</p>
                        <p><strong>Cantidad en Stock:</strong> {{ $inventario->cantidad_stock }}</p>
                        <p><strong>Proveedor:</strong> {{ $inventario->producto->proveedor->persona->nombre }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
