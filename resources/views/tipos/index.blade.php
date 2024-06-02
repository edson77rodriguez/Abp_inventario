<!-- resources/views/marcas/create.blade.php -->
@extends('dashboard')
@section('crud_content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tipos</title>
    <!-- Bootstrap 5 (CSS y JS) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Fwhij5wX9YjAJxm85MMzR1h7vfqZ6P6r64tCcdyecf5W450YfN2vQ9F3iZ2yW3j" crossorigin="anonymous">
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{asset('css/estilo_index.css')}}">
</head>
<body>
   
    <main class="container">
        <ul class="navbar-nav mr-auto flex-row">
            <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
            </li>
        </ul>
        <h2 class="text-center mb-4">Lista de tipos</h2>
        <div class="mb-3 text-end">
        <a href="{{ route('tipos.create') }}" class="btn btn-dark text-white">+ Tipo </a>
        </div>

        <div class="table-container">
            <table class="table table-bordered table-hover w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tipos as $tipo)
                        <tr>
                            <td>{{ $tipo->id }}</td>
                            <td>{{ $tipo->descripcion }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('tipos.edit', $tipo->id) }}" class="btn btn-sm btn-info me-4">Editar</a>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $tipo->id }}')">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KF6o/kJF/b7ICQ1Zfs0cQ45oM0v4lL+SzR0t4i0p54K/xY8q3jOAV5tQ9l" crossorigin="anonymous"></script>
    <script>
        function confirmDelete(id) {
            if (confirm('¿Estás seguro de que deseas eliminar esta marca?')) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '/tipos/' + id;
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
@endsection
