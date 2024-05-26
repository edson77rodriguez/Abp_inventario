<!-- resources/views/marcas/create.blade.php -->
@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tallas</title>
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
        <h2 class="text-center mb-4">Lista de tallas</h2>
        <div class="mb-3 text-end">
        <a href="{{ route('tallas.create') }}" class="btn btn-dark text-white">+ talla </a>
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
                    @foreach($tallas as $talla)
                        <tr>
                            <td>{{ $talla->id }}</td>
                            <td>{{ $talla->descripcion }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('tallas.edit', $talla->id) }}" class="btn btn-sm btn-info me-4">Editar</a>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $talla->id }}')">Eliminar</button>
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
                form.action = '/tallas/' + id;
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
@endsection
