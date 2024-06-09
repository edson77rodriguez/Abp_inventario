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
                                <button type="submit" class="btn btn-danger p-1" onclick="return confirm('¿Estás seguro de querer eliminar este producto?')">Eliminar</button>
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
                                            <label for="tipo" class="form-label">Tipo</label>
                                            <input type="text" name="tipo" id="tipo" value="{{ $producto->tipo->descripcion }}" class="form-control" required>
                                        </div>
                                        <!-- Agrega aquí el resto de los campos del formulario -->
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

                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo</label>
                            <input type="text" name="tipo" id="tipo" class="form-control" required>
                        </div>
                        <!-- Agrega aquí el resto de los campos del formulario -->
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

<!-- Incluye los scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkM0dKwdb9r1X5DOl5b0DDA6r9E/cgAqXT9Zt1KfRXjFfg7B8dTf" crossorigin="anonymous"></script>
@endsection
