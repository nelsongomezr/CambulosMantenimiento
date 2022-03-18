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
  $id=$Quercond[0]['idConductor'];
  
}else
{
  $Quercond=$querycond->queryconductor($_SESSION['varid']);
  $id=$Quercond[0]['idConductor']; 
  
}

$edad= $querycond->old($Quercond[0]['Edad']);
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

<div class="accordion accordion-flush container" id="accordionFlushExample">
        <form method="POST" enctype="multipart/form-data">
        <div class="accordion-item bg-secondary bg-opacity-10">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                <b>Informacion general</b>
                </button>
            </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <label class="form-label">
                  <b>identificacion</b><br>
                  <input type="text" class="form-control" value="<?php echo $Quercond[0]['idConductor'];?>" disabled>
                </label>
                <label class="form-label">
                  <b>Edad</b><br>
                  <input type="text" class="form-control" value="<?php echo $edad['0'];?>" disabled>
                </label>
              <label class="form-label">
                <b>Telefono</b><br>
                <input type="text" class="form-control" value="<?php echo $Quercond[0]['TelelfonoConductor'];?>" disabled>
              </label>
              <label class="form-label">
                <b>Actividad</b><br>
                <input type="text" class="form-control" value="<?php echo $Quercond[0]['UsoVheiculocol'];?>" disabled>
              </label>
              <label class="form-label">
                <b>Tipo Contrato</b><br>
                <input type="text" class="form-control" value="<?php echo $Quercond[0]['Contrato'];?>" disabled>
              </label>
            </div>

          <div class="accordion-body">
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
              </label>
          </div>
          <div class="accordion-body">
            <button type="button" class="btn btn-ligth"><?php echo'<a href=conductorupdate.php?id='.$id=$Quercond[0]['idConductor'].'>'; ?>Actualizar informacion</a></button>
            <button type="button" class="btn btn-ligth"><?php echo'<a href=conductordelete.php?id='.$id=$Quercond[0]['idConductor'].'>'; ?>Eliminar conductor</a></button> 
          </div>
        </div>
        </div>
        <div class="accordion-item bg-secondary bg-opacity-10">
            <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                <b>Informacion licencia</b>
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <label class="form-label">
                    <b>Tipo licencia</b><br>
                    <input type="text" class="form-control" value="<?php echo $Quercond[0]['TipoLicencia'];?>" disabled>
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
                </div>
            </div>
        </div>
        <div class="accordion-item bg-secondary bg-opacity-10">
            <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                <b>Documentos</b>
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <button type="button" class="btn btn-light">
                    <a href="<?php echo $Quercond[0]['ArchAutoDescuento'];?>"><b>Formato autorizacion de descuento</b></a>
                  </button>
                  <button type="button" class="btn btn-light">
                    <a href="<?php echo $Quercond[0]['ArchAperturaCaja'];?>"><b>Formato apertura caja menor</b></a>
                  </button>
                  <button type="button" class="btn btn-light">
                    <a href="<?php echo $Quercond[0]['ArchEquipoMovil'];?>"><b>Formato responsivo equipo movil</b></a>
                  </button>
                </div>
            </div>
        </div>
        <div class="accordion-item bg-secondary bg-opacity-10">
            <h2 class="accordion-header" id="flush-headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                <b>Informacion adicional</b>
                </button>
            </h2>
            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">

              <button type="button" class="btn btn-light">
              <?php echo'<a href=reportecomparendos.php?id='.$id; ?><b>Reporte comparendos</b><br></a>
              
              </button>
              <button type="button" class="btn btn-light">
                <a href="#"><b>Reporte incidentes</b></a>
              </button>
              <button type="button" class="btn btn-light">
                <a href="#"><b>Reporte accidentes</b></a>
            </button>
            <button type="button" class="btn btn-light">
              <a href="#"><b>Acciones de seguridad vial realizadas</b></a>
            </button>
            </div>
        </div>
    </div>
    <br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php
      require('partials/footer.php');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
</html>