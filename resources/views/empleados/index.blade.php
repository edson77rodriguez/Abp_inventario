@extends('dashboard')

@section('crud_content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <!-- Bootstrap 5 (CSS y JS) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Fwhij5wX9YjAJxm85MMzR1h7vfqZ6P6r64tCcdyecf5W450YfN2vQ9F3iZ2yW3j" crossorigin="anonymous">
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{asset('css/estilo_index.css')}}">
</head>
<body>
   
    <main class="container">
        
    <div class="card-header"> 
        <div style="display: flex; justify-content: space-between; align-items: center;">
                <span id="card_title">{{ __('Empleados') }}</span>
            
                    <div class="float-right">
                        <a href="{{ route('empleados.create') }}" class="btn btn-dark me-3 float-right"  data-placement="left">
                        {{ __('Create New') }}</a>
                    </div>
                
        </div>
        </div>

        <div class="table-container">
            <table class="table table-bordered table-hover w-100">
                <thead>
                    <tr id='tablab'>
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
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-sm btn-info me-2 p-1 float-right" data-bs-toggle="modal" data-bs-target="#editModal{{ $empleado->id }}">Editar</button>
                                    <button type="button" class="btn btn-sm btn-info me-2 p-1 float-right" data-bs-toggle="modal" data-bs-target="#showModal{{ $empleado->id }}">Show</button>

                                    <button type="button" class="btn btn-sm btn-danger me-2 p-1 float-left" onclick="confirmDelete('{{ $empleado->id }}')">Eliminar</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $empleado->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $empleado->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $empleado->id }}">Editar Empleado</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Formulario de edición -->
                                        <form action="{{ route('empleados.edit', $empleado->id) }}" method="POST">
                                            @csrf
                                            @method('GET')
                                            <button type="submit" class="btn btn-sm btn-info">Editar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Show Modal -->
                        <div class="modal fade" id="showModal{{ $empleado->id }}" tabindex="-1" aria-labelledby="showModalLabel{{ $empleado->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showModalLabel{{ $empleado->id }}">Detalles del Empleado</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Contenido de los detalles -->
                                        <p>ID: {{ $empleado->id }}</p>
                                        <p>Empleado: {{ $empleado->persona->nombre }} {{ $empleado->persona->ap }} {{ $empleado->persona->am }}</p>
                                        <p>Cargo: {{ $empleado->cargo->descripcion }}</p>
                                        <p>Fecha de Inicio: {{ $empleado->fecha_inicio }}</p>
                                        <p>Fecha de Fin: {{ $empleado->fecha_fin }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Crear Nuevo Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de creación -->
                    <form action="{{ route('empleados.store') }}" method="POST">
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
                            <select class="form-select" id="cargo_id" name="cargo_id" required>
                                @foreach($cargos as $cargo)
                                    <option value="{{ $cargo->id }}">{{ $cargo->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KF6o/kJF/b7ICQ1Zfs0cQ45oM0v4lL+SzR0t4i0p54K/xY8q3jOAV5tQ9l" crossorigin="anonymous"></script>
    <script>
        function confirmDelete(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este chalan?')) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '/empleados/' + id;
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>

@endsection

