<!-- resources/views/marcas/create.blade.php -->
@extends('dashboard')
@section('crud_content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Composicion</title>
    <!-- Bootstrap 5 (CSS y JS) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Fwhij5wX9YjAJxm85MMzR1h7vfqZ6P6r64tCcdyecf5W450YfN2vQ9F3iZ2yW3j" crossorigin="anonymous">
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{asset('css/estilo_index.css')}}">
</head>
<body>
   
    <main class="container">
    <div class="card-header"> 
        <div style="display: flex; justify-content: space-between; align-items: center;">
                <span id="card_title">{{ __('Composicion') }}</span>
            
                    <div class="float-right">
                        <a href="{{ route('composiciones.create') }}" class="btn btn-dark me-3 float-right"  data-placement="left">
                        {{ __('Create New') }}</a>
                    </div>
                
        </div>
        </div>

        <div class="table-container">
            <table class="table table-bordered table-hover w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Composiciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($composiciones as $composicion)
                        <tr>
                            <td>{{ $composicion->id }}</td>
                            <td>{{ $composicion->composicion }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('composiciones.edit', $composicion->id) }}" class="btn btn-sm btn-info me-4">Editar</a>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $composicion->id }}')">Eliminar</button>
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
            if (confirm('¿Estás seguro de que deseas eliminar este estilo?')) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '/Composiciones/' + id;
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
@endsection
