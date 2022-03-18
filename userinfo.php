<?php
print_r($_GET);
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
$querycond= new  user;

if(!$_GET==0 or($_GET==""))
{
  $Quercond=$querycond->queryuser($_GET['id']);
  $id=$Quercond[0]['idUsuario'];
}else
{
  $Quercond=$querycond->queryuser($_SESSION['varid']);
  $id=$Quercond[0]['idUsuario'];
  
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
                  <b>Documento de Identidad</b><br>
                  <input type="text" class="form-control" value="<?php echo $Quercond[0]['idUsuario'];?>" disabled>
                </label>
              <label class="form-label">
                <b>Telefono</b><br>
                <input type="text" class="form-control" value="<?php echo $Quercond[0]['Telefono'];?>" disabled>
              </label>
              <label class="form-label">
                <b>Rol</b><br>
                <input type="text" class="form-control" value="<?php echo $Quercond[0]['NombreRol'];?>" disabled>
              </label>
              <label class="form-label">
                <b>E-mail</b><br>
                <input type="text" class="form-control" value="<?php echo $Quercond[0]['Email'];?>" disabled>
              </label>
            </div>
        </div>
    </div>
</div>
<br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php
      require('partials/footer.php');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
</html>