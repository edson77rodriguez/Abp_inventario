@extends('dashboard')
@section('crud_content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>proveedors</title>
    <!-- Bootstrap 5 (CSS y JS) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Fwhij5wX9YjAJxm85MMzR1h7vfqZ6P6r64tCcdyecf5W450YfN2vQ9F3iZ2yW3j" crossorigin="anonymous">
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{asset('css/estilo_index.css')}}">
</head>
<div class="container py-5">
<div class="card-header"> 
        <div style="display: flex; justify-content: space-between; align-items: center;">
                <span id="card_title">{{ __('Detalles Ventas') }}</span>
            
                    <div class="float-right">
                        <a href="{{ route('detalleventas.create') }}" class="btn btn-dark me-3 float-right"  data-placement="left">
                        {{ __('Create New') }}</a>
                    </div>
                
        </div>
        </div>
    <div class="table-container">
        
    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Venta</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio de venta</th>
                                    <th>Tipo de pago</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalleventas as $detalleventa)
                                <tr>
                                    <td>{{ $detalleventa->id }}</td>
                                    <td>{{ $detalleventa->venta->fecha_venta }} </td>
                                    <td>{{ $detalleventa->producto->tipo->descripcion }} {{ $detalleventa->producto->marca->marca }}</td>
                                    <td>{{ $detalleventa->cantidad }}</td>
                                    <td>{{ $detalleventa->precio_unitario }}</td>
                                    <td>{{ $detalleventa->tipopago->tipo }} </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                        <a href="{{ route('detalleventas.show', $detalleventa->id) }}" class="btn btn-info me-2 p-1">Ver</a>
                                            <a href="{{ route('detalleventas.edit', $detalleventa->id) }}" class="btn btn-sm btn-info me-2">Editar</a>
                                            <form action="{{ route('detalleventas.destroy', $detalleventa->id) }}" method="POST">
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

