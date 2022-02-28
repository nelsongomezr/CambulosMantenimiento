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
require("class/class.php");
$us=$_GET['id'];
$_SESSION['varid']=$us;
$user= new user;
$nav=new rol;
$veh=$nav->queryAllRol();
$userinfo=$user->queryuser($us);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="styleshheet" href="css/estilo.css">
    <title>Registro conductores</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <?php $na=$nav->navrol($_SESSION['rol']) ?>
    
    <br>
    <center><h1>ACTUALIZACION INFORMACION USUARIOS</h1></center> <BR>
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
                    <input type="number" name="idcond" value="<?php echo $userinfo[0]['idUsuario'];?>" class="form-control">
                </label>
                <label class="form-label"><b>Nombres</b><br>
                    <input type="text" name="nom"  value="<?php echo $userinfo[0]['Nombre'];?>" class="form-control">
                </label>
                <label class="form-label"><b>Apellidos</b><br>
                        <input type="text" name="ape"  value="<?php echo $userinfo[0]['Apellido'];?>" class="form-control">
                </label>
                <label class="form-label"><b>Telefono</b><br>
                        <input type="tel" name="tel"  value="<?php echo $userinfo[0]['Telefono'];?>" class="form-control">
                </label>
            </div>
            <div class="accordion-body">
                <label class="form-label"><b> E-mail:</b><br>
                    <input type="email" name="email" class="form-control" value="<?php echo $userinfo[0]['Email'];?>" >
                </label>
                <label class="form-label"><b>Rol:</b>
                    <select name="rol" class="form-select">
                        <option value="<?php echo $userinfo[0]['idRol'];?>"><?php echo $userinfo[0]['NombreRol'];?></option>
                        <?php
                            for($i=0;$i<sizeof($veh);$i++){
                        ?>
                        <option value="<?php echo $veh[$i]['idRol']; ?>"><?php echo $veh[$i]['NombreRol']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </label>
            </div>
        </div>
        </div>
        
        <br>
        <input type="submit" name="registrar" value="ACTUALIZAR" class="btn btn-dark w-50">
        </form>
    </div>    
        <br>
        <br>
    </div>
    <br>
    <?php require('partials/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
<?php
if(isset($_POST['registrar']))
{
    $update=$user->updateuser($_POST);
}
?>