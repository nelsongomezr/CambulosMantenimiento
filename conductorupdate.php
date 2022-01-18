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
$query=new conductor;
$queryv=new vehiculo;
$id=$_GET['id'];
$quer= $query->queryconductor($id);
$queryv=$queryv->queryvehiculo();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar datos conductor</title>
    <link rel="stylesheet" href="style">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <?php require('partials/navadmin.php'); ?>
    <br>
    
    <div class="container-sm">
    <center>
        <div class="card-footer text-muted bg-dark">
            <div class="card-header">
                <h1>ACTUALIZACION DATOS CONDUCTOR</h1>
            </div>
        </div>
        <div class="card-footer text-muted bg-dark">
            <form method="POST" enctype="multipart/form-data" class="">
            <div class="mb-3">
                <label class="form-label">Documento de Identidad</label>
                <input type="text" name="id" value="<?php echo $quer[0]['idConductor'];?>" class="form-control w-50">
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nom" value="<?php echo $quer[0]['Nombre'];?>" class="form-control w-50">
            </div>

            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input type="text" name="ap" value="<?php echo $quer[0]['Apellido'];?>" class="form-control w-50">
            </div>

            <div class="mb-3">
                <label class="form-label">Telefono</label>
                <input type="text" name="tel" value="<?php echo $quer[0]['TelelfonoConductor'];?>" class="form-control w-50">
            </div>

            <div class="mb-3">
                <label class="form-label">Categoria licencia</label>
                <input type="text" name="catlicen" value="<?php echo $quer[0]['CategoLicencia'];?>" class="form-control w-50">
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha vencimiento licencia</label>
                <input type="date" name="venlicen" value="<?php echo $quer[0]['VenceLicencia'];?>" class="form-control w-50">
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha inscripcion RUNT</label>
                <input type="date" name="frunt" value="<?php echo $quer[0]['InscripRUNT'];?>" class="form-control w-50">
            </div>

            <div class="mb-3">
                <label class="form-label">Edad</label>
                <input type="number" name="edad" value="<?php echo $quer[0]['Edad'];?>"  class="form-control w-50">
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de contrato</label>
                <input type="text" name="tcon" value="<?php echo $quer[0]['TipoContrato'];?>" class="form-control w-50">
            </div>

            <div class="mb-3">
                <label class="form-label">Años experiencia</label>
                <input type="text" name="expe" value="<?php echo $quer[0]['ExpConduccion'];?>" class="form-control w-50">
            </div>
            <input type="hidden" name="rol" value="<?php echo $quer[0]['Rol_idRol']; ?>">

            <div class="mb-3">
                <label class="form-label">Asignar vehiculo</label>
                <select name="idveh" class="form-select w-50">
                            <option>Seleccionar vehiculo</option>
                            <?php 
                            for($i=0;$i<sizeof($queryv);$i++){
                             ?>
                             <option value="<?php echo $queryv[$i]['idVehiculo'];?>"><?php echo $queryv[$i]['Placa'];?></option>
                             <?php 
                             }
                             ?>
                </select>  
            </div>

            <div class="mb-3">
                <label class="form-label">Cargue PDF de la licencia</label>
                <input type="file" name="cargue" class="form-control w-50">
            </div>
            <input type="submit" name="update" value="ACTUALIZAR" class="btn btn-dark w-50">
            </form>
        </div>
        </center>
    </div>
    <br>
    <?php
        require('partials/footer.php');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
<?php
if(isset($_POST['update'])){
    $update[]=$_POST;
    $que=$query->updateconductor($update);
}
?>