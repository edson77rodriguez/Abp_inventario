<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pagina Principal NB</title>
      <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}" >
      
      <link rel="stylesheet" href="{{ asset('/css/GUI1.css') }}"> 
</head>
<body>
  <header class="bg-gradient-light py-3">
  <div class="container d-flex align-items-center justify-content-between">
    <h1>NAZLI BOUTIQUE</h1>
    <nav>
      <ul class="list-unstyled d-flex mb-0">
        <li class="me-4"><a href="GUI1.html" class="text-dark">Inicio</a></li>
        <li class="me-4"><a href="GUI2.html" class="text-dark">Iniciar Sesión</a></li>
        <li class="me-4"><a href="GUI3.html" class="text-dark">Productos</a></li>
        <li><a href="GUI4.html" class="text-dark">Contacto</a></li>
      </ul>
    </nav>
  </div>
</header>

  <main class="container mt-5">
    <section class="row">
      <div class="col-md-6">
      
        <img src="{{ asset('/img/imagen1.png') }}" alt="NAZLY BOUTIQUE" class="img-fluid">
      </div>
      <div class="col-md-6">
        <h1>!No conoces aun a Nazli BOUTIQUE¡</h1>
        <p>¿Buscas ropa de playa y accesorios de calidad y estilo en Valle de Bravo? No busques más, ¡Nasly Boutique lo tiene todo para que luzcas radiante en tu próxima escapada al sol!

        Nazly Boutique te ofrece una amplia selección de trajes de baño, pareos, vestidos playeros, sandalias, bolsos y mucho más, todo cuidadosamente seleccionado para adaptarse a las últimas tendencias y a los gustos más exigentes.</p>
        <a href="STORY_P.html" class="btn btn-primary">Leer más</a>
      </div>
    </section>
    <hr class="my-5">

    <section class="row">
      <div class="col-md-4">
        <div class="card">
        
          <img src="{{ asset('/img/imge1.png') }}"  alt="Servicio 1" width="290 card" >
          <div class="card-body">
            <h5 class="card-title">Servicio 1</h5>
            <p class="card-text">Ropa casual y de playa</p>
            <a href="#" class="btn btn-light">Ver más</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img src="{{ asset('/img/img2.webp') }}" alt="Servicio 2" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">Servicio 2</h5>
            <p class="card-text">Tenis y zapatos</p>
            <a href="#" class="btn btn-light">Ver más</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img src="{{ asset('/img/imag3.webp') }}" alt="Servicio 3" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">Servicio 3</h5>
            <p class="card-text">Ropa interior</p>
            <a href="#" class="btn btn-light">Ver más</a>
          </div>
        </div>
      </div>
    </section>
  </main>
</body>
</html>>