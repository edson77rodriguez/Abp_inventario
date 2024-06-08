@extends('dashboard')

@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="font-weight-bold text-primary">
                {{ __('Nuevo Producto') }}
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('productos.store') }}">
                        @csrf

                        <!-- Categoría -->
                        <div class="mb-3">
                            <label for="tipo_id" class="form-label">Categoría</label>
                            <select name="tipo_id" id="tipo_id" class="form-select" required>
                                <option value="">Seleccione una categoría</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Marca -->
                        <div class="mb-3">
                            <label for="marca_id" class="form-label">Marca</label>
                            <select name="marca_id" id="marca_id" class="form-select" required>
                                <option value="">Seleccione una marca</option>
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->marca }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Talla -->
                        <div class="mb-3">
                            <label for="talla_id" class="form-label">Talla</label>
                            <select name="talla_id" id="talla_id" class="form-select" required>
                                <option value="">Seleccione una talla</option>
                                @foreach ($tallas as $talla)
                                    <option value="{{ $talla->id }}">{{ $talla->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Género -->
                        <div class="mb-3">
                            <label for="genero_id" class="form-label">Género</label>
                            <select name="genero_id" id="genero_id" class="form-select" required>
                                <option value="">Seleccione un género</option>
                                @foreach ($generos as $genero)
                                    <option value="{{ $genero->id }}">{{ $genero->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Modelo -->
                        <div class="mb-3">
                            <label for="modelo_id" class="form-label">Modelo</label>
                            <select name="modelo_id" id="modelo_id" class="form-select" required>
                                <option value="">Seleccione un modelo</option>
                                @foreach ($modelos as $modelo)
                                    <option value="{{ $modelo->id }}">{{ $modelo->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Color -->
                        <div class="mb-3">
                            <label for="color_id" class="form-label">Color</label>
                            <select name="color_id" id="color_id" class="form-select" required>
                                <option value="">Seleccione un color</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Composición -->
                        <div class="mb-3">
                            <label for="composicion_id" class="form-label">Composición</label>
                            <select name="composicion_id" id="composicion_id" class="form-select" required>
                                <option value="">Seleccione una composición</option>
                                @foreach ($composiciones as $composicion)
                                    <option value="{{ $composicion->id }}">{{ $composicion->composicion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Estilo -->
                        <div class="mb-3">
                            <label for="estilo_id" class="form-label">Estilo</label>
                            <select name="estilo_id" id="estilo_id" class="form-select" required>
                                <option value="">Seleccione un estilo</option>
                                @foreach ($estilos as $estilo)
                                    <option value="{{ $estilo->id }}">{{ $estilo->estilo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Precio de compra -->
                        <div class="mb-3">
                            <label for="precio_compra" class="form-label">Precio de compra</label>
                            <input type="number" name="precio_compra" id="precio_compra" step="0.01" class="form-control" required>
                        </div>

                        <!-- Precio de venta -->
                        <div class="mb-3">
                            <label for="precio_venta" class="form-label">Precio de venta</label>
                            <input type="number" name="precio_venta" id="precio_venta" step="0.01" class="form-control" required>
                        </div>

                        <!-- Proveedor -->
                        <div class="mb-3">
                            <label for="proveedor_id" class="form-label">Proveedor</label>
                            <select name="proveedor_id" id="proveedor_id" class="form-select" required>
                                <option value="">Seleccione un proveedor</option>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->persona->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botones de acción -->
                        <div class="row justify-content-end">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-dark me-3">Guardar</button>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
