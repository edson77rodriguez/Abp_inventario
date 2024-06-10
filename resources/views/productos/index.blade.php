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
    <div class="table-container">
        <table class="table table-bordered table-hover w-100">
            <thead id="tablab">
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Talla</th>
                    <th>Género</th>
                    <th>Modelo</th>
                    <th>Color</th>
                    <th>Composición</th>
                    <th>Estilo</th>
                    <th>Precio C</th>
                    <th>Precio V</th>
                    <th>Proveedor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr id='demo'>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->tipo->descripcion }}</td>
                        <td>{{ $producto->marca->marca }}</td>
                        <td>{{ $producto->talla->descripcion }}</td>
                        <td>{{ $producto->genero->descripcion }}</td>
                        <td>{{ $producto->modelo->descripcion }}</td>
                        <td>{{ $producto->color->descripcion }}</td>
                        <td>{{ $producto->composicion->composicion }}</td>
                        <td>{{ $producto->estilo->estilo }}</td>
                        <td>{{ $producto->precio_compra }}</td>
                        <td>{{ $producto->precio_venta }}</td>
                        <td>{{ $producto->proveedor->persona->nombre }}</td>
                        <td>
                            <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewProductModal{{ $producto->id }}">Ver</button>
                            <button class="btn btn-primary me-2 p-1" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $producto->id }}">Editar</button>
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $producto->id }}')">Eliminar</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Ver Producto -->
                    <div class="modal fade" id="viewProductModal{{ $producto->id }}" tabindex="-1" aria-labelledby="viewProductModalLabel{{ $producto->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewProductModalLabel{{ $producto->id }}">Ver Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Aquí puedes incluir los detalles del producto -->
                                    <p>ID: {{ $producto->id }}</p>
                                    <p>Tipo: {{ $producto->tipo->descripcion }}</p>
                                    <p>Marca: {{ $producto->marca->marca }}</p>
                                    <p>Talla: {{ $producto->talla->descripcion }}</p>
                                    <p>Género: {{ $producto->genero->descripcion }}</p>
                                    <p>Modelo: {{ $producto->modelo->descripcion }}</p>
                                    <p>Color: {{ $producto->color->descripcion }}</p>
                                    <p>Composición: {{ $producto->composicion->composicion }}</p>
                                    <p>Estilo: {{ $producto->estilo->estilo }}</p>
                                    <p>Precio C: {{ $producto->precio_compra }}</p>
                                    <p>Precio V: {{ $producto->precio_venta }}</p>
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
                                    <!-- Aquí puedes incluir el formulario de edición del producto -->
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
                                <option value="">Seleccione una composicion</option>
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
                                            <button type="submit" class="btn btn-primary me-3">Guardar Cambios</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Crear Producto -->
    <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProductModalLabel">Crear Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-3">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KF6o/kJF/b7ICQ1Zfs0cQ45oM0v4lL+SzR0t4i0p54K/xY8q3jOAV5tQ9l" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css"/>
<link href="{{ asset('/css/alertify.min.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/alertify.min.js') }}"></script>

<script>
    function confirmDelete(id) {
        alertify.confirm('Eliminar', '¿Estás seguro de que deseas eliminar esta producto?', function(){
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '/productos/' + id;
            form.innerHTML = '@csrf @method("DELETE")';
            document.body.appendChild(form);
            form.submit();
        }, function(){
            alertify.error('Cancelado');
        });
    }
</script>

<script>
     alertify.set('notifier', 'position', 'top-center');
    alertify.set('notifier', 'classes', {
        'success': 'bg-success text-white',
        'error': 'bg-danger text-white',
        'warning': 'bg-warning text-dark'
    });
    alertify.set('notifier', 'delay', 3);
    function confirmDelete(id) {
        alertify.confirm('Eliminar', '¿Estás seguro de que deseas eliminar este d_venta?', function(){
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '/productos/' + id;
            form.innerHTML = '@csrf @method("DELETE")';
            document.body.appendChild(form);
            form.submit();
        }, function(){
            alertify.error('Cancelado');
        });
    }
</script>
@if(session('register'))
        <script>
            alertify.success('Registro exitoso');
        </script>
@endif
@if(session('destroy'))
        <script>
            alertify.success('Eliminado');
        </script>
@endif
@endsection