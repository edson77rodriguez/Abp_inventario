@extends('dashboard')

@section('crud_content')
<div class="container py-5">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Ventas') }}</span>
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
                                    <th>Fecha de venta</th>
                                    <th>¿Quien lo vendio?</th>
                                    <th>Ganancia</th>
                                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                 @foreach ($ventas as $venta)
                                <tr id='demo'>
                                    <td>{{ $venta->id }}</td>
                                    <td>{{ $venta->fecha_venta }}</td>
                                    <td>{{ $venta->empleado->persona->nombre }} {{ $venta->empleado->persona->ap  }} {{ $venta->empleado->persona->am  }} </td>
                                    <td>{{ $venta->ganancia }}</td>
                                    <td>
                            <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewVentaModal{{ $venta->id }}">Ver</button>
                            <button class="btn btn-primary me-2 p-1" data-bs-toggle="modal" data-bs-target="#editVentaModal{{ $venta->id }}">Editar</button>
                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $venta->id }}')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Modal Ver Producto -->
                    <div class="modal fade" id="viewVentaModal{{ $venta->id }}" tabindex="-1" aria-labelledby="viewVentaMarcaLabel{{ $venta->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewVentaModalLabel{{ $venta->id }}">Ver Venta</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                    <ul class="list-group list-group-flush">
                                       <li class="list-group-item"><strong>Fecha de venta:</strong> {{ $venta->fecha_venta }}</li>
                                        <li class="list-group-item"><strong>Empleado:</strong> {{ $venta->empleado->persona->nombre }} {{ $venta->empleado->persona->ap }} {{ $venta->empleado->persona->am }}</li>
                                        <li class="list-group-item"><strong>Total venta:</strong> {{ $venta->ganancia }}</li>
                                    </ul>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Editar Producto -->
                    <div class="modal fade" id="editVentaModal{{ $venta->id }}" tabindex="-1" aria-labelledby="editVentaModalLabel{{ $venta->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editVentaModalLabel{{ $venta->id }}">Editar Venta</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Aquí se incluye el formulario de edición del producto -->
                                    <form method="POST" action="{{ route('ventas.update', $venta->id) }}">
                                        @csrf
                                        @method('PUT')
                                            <div class="mb-3">
                                            <label for="fecha_venta" class="form-label">Fecha de venta</label>
                                            <input type="date" name="fecha_venta" id="fecha_venta" value="{{ $venta->fecha_venta }}" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="empleado_id" class="form-label">¿No lo vendio el entonces?</label>
                                            <select name="empleado_id" id="empleado_id" class="form-select" required>
                                                <option value="">Seleccione un empleado</option>
                                                @foreach ($empleados as $empleado)
                                                    <option value="{{ $empleado->id }}" {{ $venta->empleado_id == $empleado->id ? 'selected' : '' }}>
                                                        {{ $empleado->persona->nombre }} {{ $empleado->persona->am }} {{ $empleado->persona->am }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="ganancia" class="form-label">Ganancia</label>
                                            <input type="number" name="ganancia" id="ganancia" value="{{ $venta->ganancia }}" class="form-control" required>
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
                    <h5 class="modal-title" id="createVentaModalLabel">Crear Nueva Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('ventas.store') }}">
                        @csrf

                            <div class="mb-3">
                            <label for="fecha_venta" class="form-label">Fecha de venta</label>
                            <input type="date" name="fecha_venta" id="fecha_venta" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="empleado_id" class="form-label">¿Quien lo vendio?</label>
                            <select name="empleado_id" id="empleado_id" class="form-select" required>
                                <option value="">Seleccione un empleado</option>
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}">{{ $empleado->persona->nombre }} {{ $empleado->persona->ap }} {{ $empleado->persona->am }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="ganancia" class="form-label">Cantidad en Stock</label>
                            <input type="number" name="ganancia" id="ganancia" class="form-control" required>
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
            form.action = '/ventas/' + id;
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
