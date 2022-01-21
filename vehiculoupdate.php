<?php
  session_start();
  if($_SESSION==null || $_SESSION=="")
{
  echo "<script type='text/javascript'>
  alert('usted no tiene acceso permitido');
  window.location='index.php';
  </script>";
  die();
}

require('class/class.php');
$rols= new Rol;
$querycond= new  conductor;

if(!$_GET==0 or($_GET==""))
{
  $Quercond=$querycond->queryconductor($_GET['id']);
}else
{
  $Quercond=$querycond->queryconductor($_SESSION['varid']);
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Informacion del conductor</title>
  </head>
  <body>
    <?php
      $ro=$rols->navrol($_SESSION['rol']);
      echo  "<br><center><h1>".$Quercond[0]['Nombre']." ".$Quercond[0]['Apellido']."</h1></center>";
    ?>
    <div class="accordion" id="accordionPanelsStayOpenExample">
  <!--informacion general-->
  <div class="accordion-item bg-secondary bg-opacity-10">
    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
        Informacion general
      </button>
    </h2>
    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
      <div class="accordion-body">
            <center>
            <label class="form-label">
              <b>identificacion</b><br>
              <input type="text" class="form-control" value="<?php echo $Quercond[0]['idConductor'];?>" disabled>
            </label>
            <label class="form-label">
              <b>Edad</b><br>
              <input type="text" class="form-control" value="<?php echo $Quercond[0]['Edad'];?>" disabled>
            </label>
            <label class="form-label">
              <b>Telefono</b><br>
              <input type="text" class="form-control" value="<?php echo $Quercond[0]['TelelfonoConductor'];?>" disabled>
            </label>
            <label class="form-label">
              <b>Actividad</b><br>
              <input type="text" class="form-control" value="<?php echo $Quercond[0]['UsoVheiculocol'];?>" disabled>
            </label>
            <br>
            <label class="form-label">
              <b>Tipo Contrato</b><br>
              <input type="text" class="form-control" value="<?php echo $Quercond[0]['TipoContrato'];?>" disabled>
            </label>
            <label class="form-label">
              <b>Años experiencia</b><br>
              <input type="text" class="form-control" value="<?php echo $Quercond[0]['ExpConduccion'];?>" disabled>
            </label>
            <label class="form-label">
              <b>inscripcion RUNT</b><br>
              <input type="text" class="form-control" value="<?php echo $Quercond[0]['InscripRUNT'];?>" disabled>
            </label>
            <label class="form-label">
              <b>Tipo vehiculo</b><br>
              <input type="text" class="form-control" value="<?php echo $Quercond[0]['ClaseVehiculo'];?>" disabled>
            </label>
            <label class="form-label">
              <b>Vehiculo asignado</b><br>
              <input type="text" class="form-control" value="<?php echo $Quercond[0]['Placa'];?>" disabled>
            </label><br>
            <button type="button" class="btn btn-ligth"><?php echo'<a href=conductorupdate.php?id='.$id=$Quercond[0]['idConductor'].'>'; ?>Actualizar informacion</a></button>
            <button type="button" class="btn btn-ligth"><?php echo'<a href=conductordelete.php?id='.$id=$Quercond[0]['idConductor'].'>'; ?>Eliminar conductor</a></button>
            </center>
      </div>
    </div>
  </div>
  <!-- licencia -->
  <div class="accordion-item bg-secondary bg-opacity-10">
    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
        Licencia
      </button>
    </h2>
    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
      <div class="accordion-body">
        <center>
        <label class="form-label">
          <b>Tipo licencia</b><br>
          <input type="text" class="form-control" value="<?php echo $Quercond[0]['CategoLicencia'];?>" disabled>
        </label>

        <label class="form-label">
          <b>Fecha vencimiento</b><br>
          <input type="text" class="form-control" value="<?php echo $Quercond[0]['VenceLicencia'];?>" disabled>
        </label>
        <label class="form-label">
          <b>Ver licencia</b><br>
          <button type="button" class="btn btn-light">
            <a href="<?php echo $Quercond[0]['archlicencia'];?>">ver</a>
          </label>
            </button>
        </label>
        </center>
      </div>
    </div>
  </div>

  <div class="accordion-item bg-secondary bg-opacity-10">
    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
        Informacion adicional
      </button>
    </h2>
    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
      <div class="accordion-body">
        <center>
          <button type="button" class="btn btn-light">
            <a href="#"><b>Historico comparendos</b><br></a>
          </button>
          <button type="button" class="btn btn-light">
            <a href="#"><b>Deudas comparendos</b></a>
          </button>
          <button type="button" class="btn btn-light">
            <a href="<?php echo $Quercond[0]['archlicencia'];?>"><b>Reporte incidentes</b></a>
          </button>
          <button type="button" class="btn btn-light">
            <a href="<?php echo $Quercond[0]['archlicencia'];?>"><b>Reporte accidentes</b></a>
          </button>
          <button type="button" class="btn btn-light">
            <a href="<?php echo $Quercond[0]['archlicencia'];?>"><b>Acciones de seguridad vial realizadas</b></a>
          </button>
        </center>
      </div>
    </div>
  </div>
  <!-- editar y eliminar conductor-->
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php
      require('partials/footer.php');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
</html>