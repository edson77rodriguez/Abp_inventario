@extends('dashboard')

@section('template_title')
    Cargos
@endsection

@section('crud_content')
<div class="container py-5">
    <div class="card-header"> 
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Cargos') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#createCargoModal">
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
                    <th>Descripcion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cargos as $cargo)
                    <tr id="demo">
                        <td>{{ $cargo->id }}</td>
                        <td>{{ $cargo->descripcion }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-sm btn-info me-4" data-bs-toggle="modal" data-bs-target="#editCargoModal{{ $cargo->id }}">Editar</button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $cargo->id }}')">Eliminar</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Editar Cargo -->
                    <div class="modal fade" id="editCargoModal{{ $cargo->id }}" tabindex="-1" aria-labelledby="editCargoModalLabel{{ $cargo->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editCargoModalLabel{{ $cargo->id }}">Editar Cargo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('cargos.update', $cargo->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="descripcion" class="form-label">Descripción</label>
                                            <input type="text" name="descripcion" id="descripcion" value="{{ $cargo->descripcion }}" class="form-control" required>
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

    <!-- Modal Crear Cargo -->
    <div class="modal fade" id="createCargoModal" tabindex="-1" aria-labelledby="createCargoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCargoModalLabel">Crear Nuevo Cargo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('cargos.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkM0dKwdb9r1X5DOl5b0DDA6r9E/cgAqXT9Zt1KfRXjFfg7B8dTf" crossorigin="anonymous"></script>
<script>
    function confirmDelete(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este cargo?')) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '/cargos/' + id;
            form.innerHTML = '@csrf @method("DELETE")';
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endsection
