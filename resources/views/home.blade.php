<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagina Principal NB</title>
  <!-- CSS Files -->
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
          <li class="dropdown">
            <a class="dropdown-toggle text-dark" href="#" id="catalogoDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Catálogo</a>
            <ul class="dropdown-menu" aria-labelledby="catalogoDropdown">
              @foreach ($tipos as $tipo)
                <li><a class="dropdown-item" href="{{ route('catalogo', $tipo->id) }}">{{ $tipo->descripcion }}</a></li>
              @endforeach
            </ul>
          </li>
          <li><a href="{{ url('/carrito') }}" class="text-dark">Carrito</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="container mt-5">
    <h2 class="text-center mb-4">Productos Destacados</h2>
    <div class="row">
      @foreach ($productos as $producto)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
          <div class="card h-100">
            <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->tipo->descripcion }}">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title text-center">{{ $producto->tipo->descripcion }}</h5>
              <p class="card-text"><strong>Marca:</strong> {{ $producto->marca->marca }}</p>
              <a href="{{ route('productos.detalle', $producto->id) }}" class="btn btn-info mt-auto">Ver Detalle</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </main>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.0-beta2/js/bootstrap.bundle.min.js"></script>
  <script>
    // Asegurarse de que el DOM esté completamente cargado antes de inicializar el Bootstrap JavaScript
    document.addEventListener('DOMContentLoaded', function() {
      var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
      var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl);
      });
    });
  </script>
</body>
</html>
