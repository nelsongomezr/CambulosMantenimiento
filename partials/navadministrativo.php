<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">AVICOLA CAMBULOS LOGISTICA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="homeadmin.php">Inicio</a>
        
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Gestion conductores</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="crudconductor.php">Registro conductores</a></li>
            <li><a class="dropdown-item" href="conductorquery.php">consulta conductores</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Gestion de vehiculos</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="vehiculoinsert.php">Registro vehiculos</a></li>
            <li><a class="dropdown-item" href="vehiculoquery.php">consulta vehiculos</a></li>
          </ul>
        </li>   
      </div>
      <a class="btn btn-bd-download d-lg-inline-block my-2 my-md-0 ms-md-3 btn btn-dark" href="sessiondestroy.php">Cerrar sesion</a>
      </li>
      <!--<button type="button" class="btn btn-secondary">Secondary</button>-->
    </div>
  </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>