@extends('dashboard')

@section('crud_content')
<div class="container py-5">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Inventario') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3 float-right" data-bs-toggle="modal" data-bs-target="#createInventarioModal">
                    {{ __('Create New') }}
                </button>
            </div>
        </div>
    </div>


    <div class="container mt-4">
    <div class="row">
        @foreach ($inventarios as $inventario)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $inventario->producto->tipo->descripcion }}</h5>
                        <p class="card-text"><strong>Id:</strong> {{ $inventario->id }}</p>
                        <p class="card-text"><strong>Cantidad:</strong> {{ $inventario->cantidad_stock }}</p>
                        <p class="card-text"><strong>Precio venta:</strong> {{ $inventario->precio_venta }}</p>
                        <p class="card-text"><strong>Fecha de ingreso:</strong> {{ $inventario->fecha_ingreso }}</p>
                        
                        <div class="d-flex justify-content-between">
                        <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewInventarioModal{{ $inventario->id }}">Ver</button>
                            <button class="btn btn-primary me-2 p-1" data-bs-toggle="modal" data-bs-target="#editInventarioModal{{ $inventario->id }}">Editar</button>
                            <form action="{{ route('inventarios.destroy', $inventario->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $inventario->id }}')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                    <!-- Modal Ver Producto -->
                    <div class="modal fade" id="viewInventarioModal{{ $inventario->id }}" tabindex="-1" aria-labelledby="viewInventarioMarcaLabel{{ $inventario->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewInventarioModalLabel{{ $inventario->id }}">Ver Inventario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Producto:</strong> {{ $inventario->producto->tipo->descripcion }} {{ $inventario->producto->modelo->descripcion }} {{ $inventario->producto->marca->marca }}</li>
                                        <li class="list-group-item"><strong>Cantidad en Stock:</strong> {{ $inventario->cantidad_stock }}</li>
                                        <li class="list-group-item"><strong>Precio de Venta:</strong> {{ $inventario->precio_venta }}</li>
                                        <li class="list-group-item"><strong>Fecha de Ingreso:</strong> {{ $inventario->fecha_ingreso }}</li>
                                    </ul>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Editar Producto -->
                    <div class="modal fade" id="editInventarioModal{{ $inventario->id }}" tabindex="-1" aria-labelledby="editInventarioModalLabel{{ $inventario->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editInventarioModalLabel{{ $inventario->id }}">Editar Inventario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Aquí puedes incluir el formulario de edición del producto -->
                                    <form method="POST" action="{{ route('inventarios.update', $inventario->id) }}">
                                        @csrf
                                        @method('PUT')

                                         
                                         <div class="mb-3">
                                            <label for="producto_id" class="form-label">Producto</label>
                                            <select name="producto_id" id="producto_id" class="form-select" required>
                                                <option value="">Seleccione un Producto</option>
                                                @foreach ($productos as $producto)
                                                    <option value="{{ $producto->id }}" {{ $inventario->producto_id == $producto->id ? 'selected' : '' }}>
                                                        {{ $producto->tipo->descripcion }} {{ $producto->modelo->descripcion }} {{ $producto->marca->marca }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="cantidad_stock" class="form-label">Cantidad en Stock</label>
                                            <input type="number" name="cantidad_stock" id="cantidad_stock" value="{{ $inventario->cantidad_stock }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="precio_venta" class="form-label">Precio de Venta</label>
                                            <input type="number" name="precio_venta" id="precio_venta" value="{{ $inventario->precio_venta }}" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                                            <input type="date" name="fecha_ingreso" id="fecha_ingreso" value="{{ $inventario->fecha_ingreso }}" class="form-control" required>
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
    <div class="modal fade" id="createInventarioModal" tabindex="-1" aria-labelledby="createInventarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createInventarioModalLabel">Crear Nuevo Inventario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('inventarios.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="producto_id" class="form-label">Producto</label>
                            <select name="producto_id" id="producto_id" class="form-select" required>
                                <option value="">Seleccione un Producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->tipo->descripcion }} {{ $producto->modelo->descripcion }} {{ $producto->marca->marca }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="cantidad_stock" class="form-label">Cantidad en Stock</label>
                            <input type="number" name="cantidad_stock" id="cantidad_stock" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="precio_venta" class="form-label">Precio de Venta</label>
                            <input type="number" name="precio_venta" id="precio_venta" class="form-control" required>
                        </div>


                        <div class="mb-3">
                            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" required>
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
            form.action = '/inventarios/' + id;
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
