@extends('dashboard')

@section('crud_content')
<div class="container py-5">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Ventas') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3 float-right" data-bs-toggle="modal" data-bs-target="#createVentaModal">
                    {{ __('Crear Nueva Venta') }}
                </button>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover w-100">
        <thead>
            <tr id="tablab">
                <th>ID</th>
                <th>Producto</th>
                <th>Fecha de Venta</th>
                <th>Empleado</th>
                <th>Cantidad</th>
                <th>Ganancia</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
                <tr id="demo">
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->producto->tipo->descripcion ?? 'hN/A' }}</td>
                    <td>{{ $venta->fecha_venta }}</td>
                    <td>{{ $venta->empleado->persona->nombre ?? 'N/A' }} {{ $venta->empleado->persona->ap ?? '' }} {{ $venta->empleado->persona->am ?? '' }}</td>
                    <td>{{ $venta->cantidad }}</td>
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
                <!-- Modal Ver Venta -->
                <div class="modal fade" id="viewVentaModal{{ $venta->id }}" tabindex="-1" aria-labelledby="viewVentaMarcaLabel{{ $venta->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewVentaModalLabel{{ $venta->id }}">Ver Venta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Fecha de Venta:</strong> {{ $venta->fecha_venta }}</li>
                                <li class="list-group-item"><strong>Empleado:</strong> {{ $venta->empleado->persona->nombre }} {{ $venta->empleado->persona->ap }} {{ $venta->empleado->persona->am }}</li>
                                <li class="list-group-item"><strong>Total Venta:</strong> {{ $venta->ganancia }}</li>
                            </ul>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Editar Venta -->
                <div class="modal fade" id="editVentaModal{{ $venta->id }}" tabindex="-1" aria-labelledby="editVentaModalLabel{{ $venta->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editVentaModalLabel{{ $venta->id }}">Editar Venta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('ventas.update', $venta->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="fecha_venta" class="form-label">Fecha de Venta</label>
                                        <input type="date" name="fecha_venta" id="fecha_venta" value="{{ $venta->fecha_venta }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="empleado_id" class="form-label">Empleado</label>
                                        <select name="empleado_id" id="empleado_id" class="form-select" required>
                                            <option value="">Seleccione un empleado</option>
                                            @foreach ($empleados as $empleado)
                                                <option value="{{ $empleado->id }}" {{ $venta->empleado_id == $empleado->id ? 'selected' : '' }}>
                                                    {{ $empleado->persona->nombre }} {{ $empleado->persona->ap }} {{ $empleado->persona->am }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cantidad" class="form-label">Cantidad</label>
                                        <input type="number" name="cantidad" id="cantidad" value="{{ $venta->cantidad }}" class="form-control" required>
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

<!-- Modal Crear Venta -->
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
                        <label for="producto_id" class="form-label">Producto</label>
                        <select name="producto_id" id="producto_id" class="form-select" required>
                            <option value="">Seleccione un producto</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->tipo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_venta" class="form-label">Fecha de Venta</label>
                        <input type="date" name="fecha_venta" id="fecha_venta" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="empleado_id" class="form-label">Empleado</label>
                        <select name="empleado_id" id="empleado_id" class="form-select" required>
                            <option value="">Seleccione un empleado</option>
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}">{{ $empleado->persona->nombre }} {{ $empleado->persona->ap }} {{ $empleado->persona->am }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" required>
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

<script>
function confirmDelete(id) {
    if (confirm("¿Estás seguro de que deseas eliminar esta venta?")) {
        document.querySelector('form[action="{{ route('ventas.destroy', '') }}/' + id + '"]').submit();
    }
}
</script>
@endsection