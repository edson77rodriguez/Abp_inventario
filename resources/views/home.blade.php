<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pagina Principal NB</title>
  <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/GUI1.css') }}">
</head>
<body>
  <header class="bg-gradient-light py-3">
    <div class="container d-flex align-items-center justify-content-between">
      <h1>NAZLI BOUTIQUE</h1>
      <nav>
        <ul class="list-unstyled d-flex mb-0">
          <li class="me-4"><a href="{{ url('/') }}" class="text-dark">Inicio</a></li>
          <li class="me-4"><a href="{{ url('/login') }}" class="text-dark">Iniciar Sesión</a></li>
          <li class="me-4"><a href="{{ url('/productos') }}" class="text-dark">Productos</a></li>
          <li><a href="{{ url('/contacto') }}" class="text-dark">Contacto</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="container mt-5">
  

  <div class="container mt-4">
    <div class="row">
    @foreach ($inventarios as $inventario)
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card">
            <img src="{{ asset('storage/' . $inventario->producto->imagen) }}" class="card-img-top" alt="{{ $inventario->producto->tipo->descripcion }}">
            <div class="card-body">
                <h5 class="card-title">{{ $inventario->producto->tipo->descripcion }}</h5>
                <p class="card-text"><strong>Marca:</strong> {{ $inventario->producto->marca->marca }}</p>
                <p class="card-text"><strong>Talla:</strong> {{ $inventario->producto->talla->descripcion }}</p>
                <p class="card-text"><strong>Género:</strong> {{ $inventario->producto->genero->descripcion }}</p>
                
            </div>
        </div>
    </div>
@endforeach
            </div>
  </main>
</body>
</html>
