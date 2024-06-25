
@extends('dashboard')

@section('crud_content')
<div class="container py-5">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Productos') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3 float-right" data-bs-toggle="modal" data-bs-target="#createProductModal">
                    {{ __('Create New') }}
                </button>
            </div>
        </div>
    </div>

    <div class="container mt-4">
    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->tipo->descripcion }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->tipo->descripcion }}</h5>
                        <p class="card-text"><strong>Marca:</strong> {{ $producto->marca->marca }}</p>
                        <p class="card-text"><strong>Talla:</strong> {{ $producto->talla->descripcion }}</p>
                        <p class="card-text"><strong>Género:</strong> {{ $producto->genero->descripcion }}</p>
                        <p class="card-text"><strong>Modelo:</strong> {{ $producto->modelo->descripcion }}</p>
                        <p class="card-text"><strong>Color:</strong> {{ $producto->color->descripcion }}</p>
                        <p class="card-text"><strong>Composición:</strong> {{ $producto->composicion->composicion }}</p>
                        <p class="card-text"><strong>Estilo:</strong> {{ $producto->estilo->estilo }}</p>
                        <p class="card-text"><strong>Precio Compra:</strong> {{ $producto->precio_compra }}</p>
                        <p class="card-text"><strong>Proveedor:</strong> {{ $producto->proveedor->persona->nombre }}</p>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewProductModal{{ $producto->id }}">Ver</button>
                            <button class="btn btn-primary me-2 p-1" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $producto->id }}">Editar</button>
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $producto->id }}')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                <!-- Modal Ver Producto -->
                <div class="modal fade" id="viewProductModal{{ $producto->id }}" tabindex="-1" aria-labelledby="viewProductModalLabel{{ $producto->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewProductModalLabel{{ $producto->id }}">Ver Producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ $producto->imagen }}" class="img-fluid mb-3" alt="{{ $producto->tipo->descripcion }}">
                                <p>ID: {{ $producto->id }}</p>
                                <p>Tipo: {{ $producto->tipo->descripcion }}</p>
                                <p>Marca: {{ $producto->marca->marca }}</p>
                                <p>Talla: {{ $producto->talla->descripcion }}</p>
                                <p>Género: {{ $producto->genero->descripcion }}</p>
                                <p>Modelo: {{ $producto->modelo->descripcion }}</p>
                                <p>Color: {{ $producto->color->descripcion }}</p>
                                <p>Composición: {{ $producto->composicion->composicion }}</p>
                                <p>Estilo: {{ $producto->estilo->estilo }}</p>
                                <p>Precio Compra: {{ $producto->precio_compra }}</p>
                                <p>Proveedor: {{ $producto->proveedor->persona->nombre }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Editar Producto -->
                <div class="modal fade" id="editProductModal{{ $producto->id }}" tabindex="-1" aria-labelledby="editProductModalLabel{{ $producto->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProductModalLabel{{ $producto->id }}">Editar Producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('productos.update', $producto->id) }}" enctype="multipart/form-data">
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
                                            <option value="">Seleccione una talla</option>
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
                                            <option value="">Seleccione un género</option>
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
                                            <option value="">Seleccione un modelo</option>
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
                                            <option value="">Seleccione un color</option>
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
                                        <label for="composicion_id" class="form-label">Composición</label>
                                        <select name="composicion_id" id="composicion_id" class="form-control @error('composicion_id') is-invalid @enderror" required>
                                            <option value="">Seleccione una composición</option>
                                            @foreach ($composiciones as $composicion)
                                                <option value="{{ $composicion->id }}" {{ $composicion->id == old('composicion_id', $producto->composicion_id) ? 'selected' : '' }}>
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
                                            <option value="">Seleccione un estilo</option>
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
                                        <label for="precio_compra" class="form-label">Precio de Compra</label>
                                        <input type="number" name="precio_compra" id="precio_compra" class="form-control @error('precio_compra') is-invalid @enderror" value="{{ old('precio_compra', $producto->precio_compra) }}" required>
                                        @error('precio_compra')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="proveedor_id" class="form-label">Proveedor</label>
                                        <select name="proveedor_id" id="proveedor_id" class="form-control @error('proveedor_id') is-invalid @enderror" required>
                                            <option value="">Seleccione un proveedor</option>
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

                                    <div class="mb-3">
                                        <label for="imagen" class="form-label">Imagen</label>
                                        <input type="file" name="imagen" id="imagen" class="form-control @error('imagen') is-invalid @enderror">
                                        @error('imagen')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Crear Producto -->
    <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProductModalLabel">Crear Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="tipo_id" class="form-label">Tipo</label>
                            <select name="tipo_id" id="tipo_id" class="form-control @error('tipo_id') is-invalid @enderror" required>
                                <option value="">Seleccione un tipo</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id }}" {{ $tipo->id == old('tipo_id') ? 'selected' : '' }}>
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
                                    <option value="{{ $marca->id }}" {{ $marca->id == old('marca_id') ? 'selected' : '' }}>
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
                                <option value="">Seleccione una talla</option>
                                @foreach ($tallas as $talla)
                                    <option value="{{ $talla->id }}" {{ $talla->id == old('talla_id') ? 'selected' : '' }}>
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
                                <option value="">Seleccione un género</option>
                                @foreach ($generos as $genero)
                                    <option value="{{ $genero->id }}" {{ $genero->id == old('genero_id') ? 'selected' : '' }}>
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
                                <option value="">Seleccione un modelo</option>
                                @foreach ($modelos as $modelo)
                                    <option value="{{ $modelo->id }}" {{ $modelo->id == old('modelo_id') ? 'selected' : '' }}>
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
                                <option value="">Seleccione un color</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}" {{ $color->id == old('color_id') ? 'selected' : '' }}>
                                        {{ $color->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('color_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="composicion_id" class="form-label">Composición</label>
                            <select name="composicion_id" id="composicion_id" class="form-control @error('composicion_id') is-invalid @enderror" required>
                                <option value="">Seleccione una composición</option>
                                @foreach ($composiciones as $composicion)
                                    <option value="{{ $composicion->id }}" {{ $composicion->id == old('composicion_id') ? 'selected' : '' }}>
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
                                <option value="">Seleccione un estilo</option>
                                @foreach ($estilos as $estilo)
                                    <option value="{{ $estilo->id }}" {{ $estilo->id == old('estilo_id') ? 'selected' : '' }}>
                                        {{ $estilo->estilo }}
                                    </option>
                                @endforeach
                            </select>
                            @error('estilo_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="precio_compra" class="form-label">Precio de Compra</label>
                            <input type="number" name="precio_compra" id="precio_compra" class="form-control @error('precio_compra') is-invalid @enderror" value="{{ old('precio_compra') }}" required>
                            @error('precio_compra')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="proveedor_id" class="form-label">Proveedor</label>
                            <select name="proveedor_id" id="proveedor_id" class="form-control @error('proveedor_id') is-invalid @enderror" required>
                                <option value="">Seleccione un proveedor</option>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}" {{ $proveedor->id == old('proveedor_id') ? 'selected' : '' }}>
                                        {{ $proveedor->persona->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('proveedor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen</label>
                            <input type="file" name="imagen" id="imagen" class="form-control @error('imagen') is-invalid @enderror">
                            @error('imagen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Crear Producto</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

</body>
</html>