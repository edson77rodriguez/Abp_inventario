@extends('dashboard')

@section('template_title')
        Personas
@endsection

@section('crud_content')
<div class="container py-5">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Personas') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#createPersonaModal">
                    {{ __('Create New') }}
                </button>
            </div>
        </div>
    </div>
    <div class="table-container">
        <table class="table table-bordered table-hover w-100">
            <thead>
                <tr id="tablab">
                    <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Telefono</th>
                        <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($personas as $persona)
                    <tr id="demo">
                        <td>{{ $persona->id }}</td>
                            <td>{{ $persona->nombre }}</td>
                            <td>{{ $persona->ap }}</td>
                            <td>{{ $persona->am }}</td>
                            <td>{{ $persona->telefono }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-sm btn-info me-4" data-bs-toggle="modal" data-bs-target="#editPersonaModal{{ $persona->id }}">Editar</button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $persona->id }}')">Eliminar</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Editar Composición -->
                    <div class="modal fade" id="editPersonaModal{{ $persona->id }}" tabindex="-1" aria-labelledby="editPersonaModalLabel{{ $persona->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPersonaModalLabel{{ $persona->id }}">Editar Persona</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('personas.update', $persona->id) }}">
                                        @csrf
                                        @method('PUT')
                                         <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre </label>
                                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="ap" class="form-label">Apellido Paterno</label>
                                            <input type="text" name="ap" id="ap" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="am" class="form-label">Apellido Materno </label>
                                            <input type="text" name="am" id="am" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="telefono" class="form-label">Telefono </label>
                                            <input type="tel" name="telefono" id="telefono" class="form-control" required>
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

    <!-- Modal Crear Composición -->
    <div class="modal fade" id="createPersonaModal" tabindex="-1" aria-labelledby="createPersonaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPersonaModalLabel">Crear Nueva Persona</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('personas.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $persona->nombre) }}" class="form-control @error('pais') is-invalid @enderror" required>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ap" class="form-label">Apellido Paterno</label>
                            <input type="text" name="ap" id="ap" value="{{ old('ap', $persona->ap) }}" class="form-control @error('pais') is-invalid @enderror" required>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="am" class="form-label">APellido Materno</label>
                            <input type="text" name="am" id="am" value="{{ old('am', $persona->am) }}" class="form-control @error('pais') is-invalid @enderror" required>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="telefono" class="form-label">Telefono</label>
                            <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $persona->telefono) }}" class="form-control @error('pais') is-invalid @enderror" required>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
        alertify.confirm('Eliminar', '¿Estás seguro de que deseas eliminar esta persona?', function(){
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '/personas/' + id;
            form.innerHTML = '@csrf @method("DELETE")';
            document.body.appendChild(form);
            form.submit();
        }, function(){
            alertify.error('Cancelado');
        });
    }
</script>
@endsection
