@extends('dashboard')

@section('crud_content')
<div class="container py-5">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Empleados') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3 float-right" data-bs-toggle="modal" data-bs-target="#createEmpleadoModal">
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
                        <th>Empleado</th>
                        <th>Cargo</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                 @foreach($empleados as $empleado)
                        <tr id='demo'>
                            <td>{{ $empleado->id }}</td>
                            <td>{{ $empleado->persona->nombre }} {{ $empleado->persona->ap }} {{ $empleado->persona->am }}</td>
                            <td>{{ $empleado->cargo->descripcion }}</td>
                            <td>{{ $empleado->fecha_inicio }}</td>
                            <td>{{ $empleado->fecha_fin }}</td>
                            <td>
                            <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewEmpleadoModal{{ $empleado->id }}">Ver</button>
                            <button class="btn btn-primary me-2 p-1" data-bs-toggle="modal" data-bs-target="#editEmpleadoModal{{ $empleado->id }}">Editar</button>
                            <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $empleado->id }}')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Modal Ver Producto -->
                    <div class="modal fade" id="viewEmpleadoModal{{ $empleado->id }}" tabindex="-1" aria-labelledby="viewEmpleadoMarcaLabel{{ $empleado->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewEmpleadoModalLabel{{ $empleado->id }}">Ver Empleado</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                   <div class="mb-3">
                                   <label class="form-label">Persona: <p>{{ $empleado->persona->nombre }}</p> </label> 
                                        
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Cargo:</label>
                                        <p>{{ $empleado->cargo->descripcion }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Fecha de Inicio:</label>
                                        <p>{{ $empleado->fecha_inicio }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Fecha de Fin:</label>
                                        <p>{{ $empleado->fecha_fin ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Editar Producto -->
                    <div class="modal fade" id="editEmpleadoModal{{ $empleado->id }}" tabindex="-1" aria-labelledby="editEmpleadoModalLabel{{ $empleado->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editEmpleadoModalLabel{{ $empleado->id }}">Editar Empleado</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Aquí puedes incluir el formulario de edición del producto -->
                                    <form method="POST" action="{{ route('empleados.update', $empleado->id) }}">
                                        @csrf
                                        @method('PUT')

                                         <div class="mb-3">
                                            <label for="persona_id" class="form-label">Persona</label>
                                            <select name="persona_id" id="persona_id" class="form-control" required>
                                                <option value="">Seleccione una persona</option>
                                                @foreach ($personas as $persona)
                                                    <option value="{{ $persona->id }}" {{ $empleado->persona_id == $persona->id ? 'selected' : '' }}>{{ $persona->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="cargo_id" class="form-label">Cargo</label>
                                            <select name="cargo_id" id="cargo_id" class="form-control" required>
                                                <option value="">Seleccione un cargo</option>
                                                @foreach ($cargos as $cargo)
                                                    <option value="{{ $cargo->id }}" {{ $empleado->cargo_id == $cargo->id ? 'selected' : '' }}>{{ $cargo->descripcion }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ $empleado->fecha_inicio }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ $empleado->fecha_fin }}">
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
    <div class="modal fade" id="createEmpleadoModal" tabindex="-1" aria-labelledby="createEmpleadoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createEmpleadoModalLabel">Crear Nuevo Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('empleados.store') }}">
                        @csrf

                       <div class="mb-3">
                            <label for="persona_id" class="form-label">Persona</label>
                            <select name="persona_id" id="persona_id" class="form-control" required>
                                <option value="">Seleccione una persona</option>
                                @foreach ($personas as $persona)
                                    <option value="{{ $persona->id }}">{{ $persona->nombre }}{{ $persona->ap }} {{ $persona->am }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cargo_id" class="form-label">Cargo</label>
                            <select name="cargo_id" id="cargo_id" class="form-control" required>
                                <option value="">Seleccione un cargo</option>
                                @foreach ($cargos as $cargo)
                                    <option value="{{ $cargo->id }}">{{ $cargo->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
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
    function confirmDelete(id) {
        alertify.confirm('Eliminar', '¿Estás seguro de que deseas eliminar este empleado?', function(){
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '/empleados/' + id;
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
            form.action = '/empleados/' + id;
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
