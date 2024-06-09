@extends('dashboard')
@section('crud_content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <!-- Bootstrap 5 (CSS y JS) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Fwhij5wX9YjAJxm85MMzR1h7vfqZ6P6r64tCcdyecf5W450YfN2vQ9F3iZ2yW3j" crossorigin="anonymous">
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{asset('css/estilo_index.css')}}">
</head>
<div class="container py-5">
<div class="card-header"> 
        <div style="display: flex; justify-content: space-between; align-items: center;">
                <span id="card_title">{{ __('Ventas') }}</span>
            
                    <div class="float-right">
                        <a href="{{ route('ventas.create') }}" class="btn btn-dark me-3 float-right"  data-placement="left">
                        {{ __('Create New') }}</a>
                    </div>
                
        </div>
        </div>
    <div class="table-container">
        
    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha de venta</th>
                                    <th>¿Quien lo vendio?</th>
                                    <th>Ganancia</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ventas as $venta)
                                <tr>
                                    <td>{{ $venta->id }}</td>
                                    <td>{{ $venta->fecha_venta }}</td>
                                    <td>{{ $venta->empleado->persona->nombre }} {{ $venta->empleado->persona->ap  }} {{ $venta->empleado->persona->am  }} </td>
                                    <td>{{ $venta->ganancia }}</td>
                                    
                                    <td>
                                        <div class="d-flex justify-content-center">
                                        <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-info me-2 p-1">Ver</a>
                                            <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-sm btn-info me-2">Editar</a>
                                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
            </table>
    </div>
</div>
@endsection

