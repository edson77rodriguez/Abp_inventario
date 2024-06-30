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
                <div class="container mt-4">
    <div class="row">
    @foreach ($ventas as $venta)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $venta->fecha_venta}}</h5>
                        <p class="card-text"><strong>Id:</strong> {{ $venta->id }}</p>
                        <p class="card-text"><strong>Fecha venta:</strong> {{ $venta->fecha_venta }}</p>
                        <p class="card-text"><strong>Producto:</strong> {{ $venta->producto->tipo->descripcion ?? 'hN/A' }}</p>
                        <p class="card-text"><strong>Empleado:</strong> {{ $venta->empleado->persona->nombre ?? 'N/A' }} {{ $venta->empleado->persona->ap ?? '' }} {{ $venta->empleado->persona->am ?? '' }}</p>
                        <p class="card-text"><strong>Catidad:</strong> {{ $venta->cantidad }}</p>
                        <p class="card-text"><strong>Ganancia:</strong> {{ $venta->ganancia }}</p>

                        
                        <div class="d-flex justify-content-between">
                        <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewVentaModal{{ $venta->id }}">Ver</button>
                            <button class="btn btn-primary me-2 p-1" data-bs-toggle="modal" data-bs-target="#editVentaModal{{ $venta->id }}">Editar</button>
                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $venta->id }}')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                                <option value="{{ $producto->id }}">{{ $producto->tipo->descripcion }}</option>
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