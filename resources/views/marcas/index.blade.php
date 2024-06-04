<!-- resources/views/marcas/create.blade.php -->
@extends('dashboard')
@section('crud_content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modelos</title>
    <!-- Bootstrap 5 (CSS y JS) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Fwhij5wX9YjAJxm85MMzR1h7vfqZ6P6r64tCcdyecf5W450YfN2vQ9F3iZ2yW3j" crossorigin="anonymous">
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{asset('css/estilo_index.css')}}">
</head>
<body>
   
    <main class="container">
        
        <h2 class="text-center mb-4">Lista de Origenes</h2>
        <div class="mb-3 text-end">
        <a href="{{ route('marcas.create') }}" class="btn btn-dark text-white float-right mb-3 p-2">Nueva Marca </a>
        </div>

        <div class="table-container">
            <table class="table table-bordered table-hover w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Pais</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($marcas as $marca)
                        <tr>
                            <td>{{ $marca->id }}</td>
                            <td>{{ $marca->marca }}</td>
                            <td>{{ $marca->origen_id }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('marcas.edit', $marca->id) }}" class="btn btn-sm btn-info me-2 p-1 float-right">Editar</a>
                                    <a href="{{ route('marcas.show', $marca->id) }}" class="btn btn-sm btn-info me-2 p-1 float-right">Show</a>
                                    <button type="button" class="btn btn-sm btn-danger me-2 p-1 float-left" onclick="confirmDelete('{{ $marca->id }}')">Eliminar</button>
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
            if (confirm('¿Estás seguro de que deseas eliminar este origen?')) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '/marcas/' + id;
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
@endsection
