@extends('dashboard')

@section('template_title')
        Tipos
@endsection

@section('crud_content')
<div class="container py-5">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Tipos') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#createTipoModal">
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
                    <th>Categoria</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipos as $tipo)
                    <tr id="demo">
                        <td>{{ $tipo->id }}</td>
                        <td>{{ $tipo->descripcion }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-sm btn-info me-4" data-bs-toggle="modal" data-bs-target="#editTipoModal{{ $tipo->id }}">Editar</button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $tipo->id }}')">Eliminar</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Editar Composición -->
                    <div class="modal fade" id="editTipoModal{{ $tipo->id }}" tabindex="-1" aria-labelledby="editTipoModalLabel{{ $tipo->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editTipoModalLabel{{ $tipo->id }}">Editar Tipo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('tipos.update', $tipo->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="descripcion" class="form-label">Origen de marca</label>
                                            <input type="text" name="descripcion" id="descripcion" value="{{ $tipo->descripcion }}" class="form-control" required>
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
    <div class="modal fade" id="createTipoModal" tabindex="-1" aria-labelledby="createTipoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTipoModalLabel">Crear Nuevo Tipo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('tipos.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Tipo de prenda</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" required>
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
        alertify.confirm('Eliminar', '¿Estás seguro de que deseas eliminar este tipo?', function(){
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '/tipos/' + id;
            form.innerHTML = '@csrf @method("DELETE")';
            document.body.appendChild(form);
            form.submit();
        }, function(){
            alertify.error('Cancelado');
        });
    }
</script>
@endsection
