<?php
    require('class/class.php');
    $logi=new login;
    $qcond= new conductor;
    if(isset($_POST['login']))
    {
        $info[]=$_POST;
        $valida=new valida;
        $char=$valida->caracteres($_POST);
        $lo=$logi->log($info);
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Login Logistica Cambulos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
  <body class="bg-dark" >
      
<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">AVICOLA CAMBULOS LOGISTICA</a>
    </div>
  </div>
</nav>

<img src="img/banner_pollito_amarillo.jpeg" class="img-fluid" alt="...">

<br><br>
<center>
<div class="card text-cente w-50">
  <div class="card-header">
INGRESAR AL MODULO DE LOGISTICA CAMBULOS
  </div>

<div class="card-footer text-muted bg-dark">
  <form method="POST">
    <div class="mb-3 ">
        <label class="form-label w-50 bg-dark" >Usuario</label>
        <input type="text" name="usuario"class="form-control w-50"  aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label w-50 bg-dark" >Contraseña</label>
        <input type="password" name="pass" class="form-control w-50" id="exampleInputPassword1">
    </div>
        <input type="submit" name="login" class="btn btn-dark" value="Ingresar">
</form>
  </div>
</div>
</center>
<?php 
require('partials/footer.php');
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
</html>
