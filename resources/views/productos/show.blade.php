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
                        <li class="list-group-item"><strong>Talla:</strong> {{ $producto->talla->descripcion }}</li>
                        <li class="list-group-item"><strong>Genero:</strong> {{ $producto->genero->descripcion }}</li>
                        <li class="list-group-item"><strong>Modelo:</strong> {{ $producto->modelo->descripcion }}</li>
                        <li class="list-group-item"><strong>Color:</strong> {{ $producto->color->descripcion }}</li>
                        <li class="list-group-item"><strong>Composicion:</strong> {{ $producto->composicion->composicion }}</li>
                        <li class="list-group-item"><strong>Estilo:</strong> {{ $producto->estilo->estilo }}</li>
                        <!-- Repite el mismo patrón para los demás campos -->                        
                        <li class="list-group-item"><strong>Precio Compra:</strong> ${{ number_format($producto->precio_compra, 2) }}</li>
                        <li class="list-group-item"><strong>Precio Venta:</strong> ${{ number_format($producto->precio_venta, 2) }}</li>
                        <li class="list-group-item"><strong>Proveedor:</strong> {{ $producto->proveedor->persona->nombre }}</li>


                        
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
