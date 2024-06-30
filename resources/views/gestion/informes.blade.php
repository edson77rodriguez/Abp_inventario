<!-- resources/views/informes/index.blade.php -->

@extends('layouts.app') <!-- Ajusta según tu estructura de layout -->

@section('content')
    <div class="container">
        <h1>Informe de Ventas</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Fecha de Venta</th>
                    <!-- Agrega más columnas según tus necesidades -->
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $venta->producto->tipo->descripcion }}</td>
                        <td>{{ $venta->cantidad }}</td>
                        <td>{{ $venta->fecha_venta }}</td>
                        <!-- Ajusta las columnas según los campos de tu modelo Venta -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
