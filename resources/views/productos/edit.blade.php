@extends('dashboard')
@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center font-weight-bold text-primary">
                Editar Producto
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('productos.update', $producto->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="tipo_id" class="form-label">Tipo</label>
                            <select name="tipo_id" id="tipo_id" class="form-control @error('tipo_id') is-invalid @enderror" required>
                                <option value="">Seleccione un tipo</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id }}" {{ $tipo->id == old('tipo_id', $producto->tipo_id) ? 'selected' : '' }}>
                                        {{ $tipo->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="marca_id" class="form-label">Marca</label>
                            <select name="marca_id" id="marca_id" class="form-control @error('marca_id') is-invalid @enderror" required>
                                <option value="">Seleccione una marca</option>
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id }}" {{ $marca->id == old('marca_id', $producto->marca_id) ? 'selected' : '' }}>
                                        {{ $marca->marca }}
                                    </option>
                                @endforeach
                            </select>
                            @error('marca_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="talla_id" class="form-label">Talla</label>
                            <select name="talla_id" id="talla_id" class="form-control @error('talla_id') is-invalid @enderror" required>
                                <option value="">Seleccione una Talla</option>
                                @foreach ($tallas as $talla)
                                    <option value="{{ $talla->id }}" {{ $talla->id == old('talla_id', $producto->talla_id) ? 'selected' : '' }}>
                                        {{ $talla->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('talla_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="genero_id" class="form-label">Genero</label>
                            <select name="genero_id" id="genero_id" class="form-control @error('genero_id') is-invalid @enderror" required>
                                <option value="">Seleccione una Talla</option>
                                @foreach ($generos as $genero)
                                    <option value="{{ $genero->id }}" {{ $genero->id == old('genero_id', $producto->genero_id) ? 'selected' : '' }}>
                                        {{ $genero->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('genero_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="modelo_id" class="form-label">Modelo</label>
                            <select name="modelo_id" id="modelo_id" class="form-control @error('modelo_id') is-invalid @enderror" required>
                                <option value="">Seleccione una Talla</option>
                                @foreach ($modelos as $modelo)
                                    <option value="{{ $modelo->id }}" {{ $modelo->id == old('modelo_id', $producto->modelo_id) ? 'selected' : '' }}>
                                        {{ $modelo->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('modelo_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="color_id" class="form-label">Color</label>
                            <select name="color_id" id="color_id" class="form-control @error('color_id') is-invalid @enderror" required>
                                <option value="">Seleccione una Talla</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}" {{ $color->id == old('color_id', $producto->color_id) ? 'selected' : '' }}>
                                        {{ $color->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('color_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="composicion_id" class="form-label">Composicion</label>
                            <select name="composicion_id" id="composicion_id" class="form-control @error('composicion_id') is-invalid @enderror" required>
                                <option value="">Seleccione una Talla</option>
                                @foreach ($composiciones as $composicion)
                                    <option value="{{ $composicion->id }}" {{ $color->id == old('composicion_id', $producto->composicion_id) ? 'selected' : '' }}>
                                        {{ $composicion->composicion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('composicion_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="estilo_id" class="form-label">Estilo</label>
                            <select name="estilo_id" id="estilo_id" class="form-control @error('estilo_id') is-invalid @enderror" required>
                                <option value="">Seleccione una Talla</option>
                                @foreach ($estilos as $estilo)
                                    <option value="{{ $estilo->id }}" {{ $estilo->id == old('estilo_id', $producto->estilo_id) ? 'selected' : '' }}>
                                        {{ $estilo->estilo }}
                                    </option>
                                @endforeach
                            </select>
                            @error('estilo_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="precio_compra" class="form-label">Precio Compra</label>
                            <input type="number" name="precio_compra" id="precio_compra" value="{{ old('precio_compra', $producto->precio_compra) }}" step="0.01" class="form-control @error('precio_compra') is-invalid @enderror" required>
                            @error('precio_compra')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="precio_venta" class="form-label">Precio Venta</label>
                            <input type="number" name="precio_venta" id="precio_venta" value="{{ old('precio_venta', $producto->precio_venta) }}" step="0.01" class="form-control @error('precio_venta') is-invalid @enderror" required>
                            @error('precio_venta')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="proveedor_id" class="form-label">Proveedor</label>
                            <select name="proveedor_id" id="proveedor_id" class="form-control @error('proveedor_id') is-invalid @enderror" required>
                                <option value="">Seleccione una Talla</option>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}" {{ $proveedor->id == old('proveedor_id', $producto->proveedor_id) ? 'selected' : '' }}>
                                        {{ $proveedor->persona->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('proveedor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark me-3">Guardar</button>
                            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
