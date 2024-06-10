@extends('dashboard')

@section('crud_content')
<div class="container py-5">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('D_Ventas') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3 float-right" data-bs-toggle="modal" data-bs-target="#createVentaModal">
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
                                     <th>Venta</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio de venta</th>
                                    <th>Tipo de pago</th>
                                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detalleventas as $detalleventa)
                                <tr id='demo'>
                                    <td>{{ $detalleventa->id }}</td>
                                    <td>{{ $detalleventa->venta->fecha_venta }} </td>
                                    <td>{{ $detalleventa->producto->tipo->descripcion }} {{ $detalleventa->producto->marca->marca }}</td>
                                    <td>{{ $detalleventa->cantidad }}</td>
                                    <td>{{ $detalleventa->precio_unitario }}</td>
                                    <td>{{ $detalleventa->tipopago->tipo }} </td>
                                    <td>
                            <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewVentaModal{{ $detalleventa->id }}">Ver</button>
                            <button class="btn btn-primary me-2 p-1" data-bs-toggle="modal" data-bs-target="#editVentaModal{{ $detalleventa->id }}">Editar</button>
                            <form action="{{ route('detalleventas.destroy', $detalleventa->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $detalleventa->id }}')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Modal Ver Producto -->
                    <div class="modal fade" id="viewVentaModal{{ $detalleventa->id }}" tabindex="-1" aria-labelledby="viewVentaMarcaLabel{{ $detalleventa->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewVentaModalLabel{{ $detalleventa->id }}">Ver D_Venta</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                
                                    <ul class="list-group list-group-flush">
                                       <li class="list-group-item"><strong>Venta ID:</strong> {{ $detalleventa->venta->fecha_venta ?? 'N/A' }}</li>
                                        <li class="list-group-item"><strong>Producto:</strong> 
                                            {{ $detalleventa->producto->tipo->descripcion ?? 'N/A' }} 
                                            {{ $detalleventa->producto->modelo->descripcion ?? 'N/A' }} 
                                            {{ $detalleventa->producto->marca->marca ?? 'N/A' }}
                                        </li>
                                        <li class="list-group-item"><strong>Cantidad:</strong> {{ $detalleventa->cantidad ?? 'N/A' }}</li>
                                        <li class="list-group-item"><strong>Precio Unitario:</strong> {{ $detalleventa->precio_unitario ?? 'N/A' }}</li>
                                        <li class="list-group-item"><strong>Tipo de Pago:</strong> {{ $detalleventa->tipopago->tipo ?? 'N/A' }}</li>
                                    </ul>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Editar Producto -->
                    <div class="modal fade" id="editVentaModal{{ $detalleventa->id }}" tabindex="-1" aria-labelledby="editVentaModalLabel{{ $detalleventa->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editVentaModalLabel{{ $detalleventa->id }}">Editar D_Venta</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Aquí se incluye el formulario de edición del producto -->
                                    <form method="POST" action="{{ route('detalleventas.update', $detalleventa->id) }}">
                                        @csrf
                                        @method('PUT')
                                            <div class="mb-3">
                                            <label for="venta_id" class="form-label">Venta</label>
                                            <select name="venta_id" id="venta_id" class="form-control @error('venta_id') is-invalid @enderror" required>
                                                <option value="">Seleccione una venta</option>
                                                @foreach ($ventas as $venta)
                                                    <option value="{{ $venta->id }}" {{ $detalleventa->id == old('venta_id', $venta->fecha_venta) ? 'selected' : '' }}>
                                                        {{ $venta->fecha_venta }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('venta_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="producto_id" class="form-label">Producto</label>
                                            <select name="producto_id" id="producto_id" class="form-select" required>
                                                <option value="">Seleccione un Producto</option>
                                                @foreach ($productos as $producto)
                                                    <option value="{{ $producto->id }}" {{ $detalleventa->producto_id == $producto->id ? 'selected' : '' }}>
                                                        {{ $producto->tipo->descripcion }} {{ $producto->modelo->descripcion }} {{ $producto->marca->marca }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        

                                        <div class="mb-3">
                                            <label for="cantidad" class="form-label">Cantidad</label>
                                            <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad', $detalleventa->cantidad) }}" step="0.01" class="form-control @error('cantidad') is-invalid @enderror" required>
                                            @error('cantidad')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="precio_unitario" class="form-label">Precio Unitario</label>
                                            <input type="number" name="precio_unitario" id="precio_unitario" value="{{ old('precio_unitario', $detalleventa->precio_unitario) }}" step="0.01" class="form-control @error('precio_unitario') is-invalid @enderror" required>
                                            @error('precio_unitario')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="tipopago_id" class="form-label">Tipo pago</label>
                                            <select name="tipopago_id" id="tipopago_id" class="form-control @error('tipopago_id') is-invalid @enderror" required>
                                                <option value="">Seleccione una tipo pago</option>
                                                @foreach ($tipopagos as $tipopago)
                                                    <option value="{{ $tipopago->id }}" {{ $detalleventa->id == old('tipopago_id', $tipopago->id) ? 'selected' : '' }}>
                                                        {{ $tipopago->tipo}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('tipopago_id')
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
    <div class="modal fade" id="createVentaModal" tabindex="-1" aria-labelledby="createVentaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createVentaModalLabel">Crear Nueva D_Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('detalleventas.store') }}">
                        @csrf

                            <div class="mb-3">
                            <label for="venta_id" class="form-label">Venta</label>
                            <select name="venta_id" id="venta_id" class="form-select" required>
                                <option value="">Seleccione un Venta</option>
                                @foreach ($ventas as $venta)
                                    <option value="{{ $venta->id }}">{{ $venta->fecha_venta }}</option>
                                @endforeach
                            </select>
                        </div>

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
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="precio_unitario" class="form-label">Precio de Unitario</label>
                            <input type="number" name="precio_unitario" id="precio_unitario" step="0.01" class="form-control" required>
                        </div>

                       
                        <div class="mb-3">
                            <label for="tipopago_id" class="form-label">Detalles de venta</label>
                            <select name="tipopago_id" id="tipopago_id" class="form-select" required>
                                <option value="">Seleccione un Producto</option>
                                @foreach ($tipopagos as $tipopago)
                                    <option value="{{ $tipopago->id }}">{{ $tipopago->tipo }} </option>
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
            form.action = '/detalleventas/' + id;
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
