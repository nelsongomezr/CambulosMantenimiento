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
$cond= new conductor;
$vehi= new Vehiculo;
$veh=$vehi->queryvehiculo();
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
    <?php require('partials/navadmin.php'); ?>
    <div class="container">
    <center>
        <br>
                <div class="card-footer text-muted bg-dark">
                    <div class="card-header">
                    <h1>REGISTRO CONDUCTORES</h1>
                    </div>
                </div>
                <div class="card-footer text-muted bg-dark">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Documento de Identidad:</label>
                        <input type="number" name="idcond" placeholder="Documento identificacion" class="form-control w-50">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombres:</label>
                        <input type="text" name="nom" placeholder="Ingrese los nombres" class="form-control w-50">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apellidos:</label>
                        <input type="text" name="ape" placeholder="Ingrese los apellidos" class="form-control w-50">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefono:</label>
                        <input type="tel" name="tel" placeholder="ingrese el telefono" class="form-control w-50">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categoria Licencia:</label>
                        <input type="text" name="categolicencia" placeholder="Ingrese la categoria" class="form-control w-50">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha vencimiento licencia:</label>
                        <input type="date" name="vencelicencia" class="form-control w-50">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha inscripcion RUNT:</label>
                        <input type="date" name="frunt" class="form-control w-50">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Edad:</label>
                        <input type="number" name="edad" class="form-control w-50">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo de contrato:</label>
                        <input type="text" name="tcon" class="form-control w-50">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Años experiencia:</label>
                        <input type="text" name="expe" class="form-control w-50">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Asignar vehiculo:</label>
                        <select name="vehiculo" class="form-select w-50">
                            <option>Seleccione el vehiculo</option>
                            <?php
                                for($i=0;$i<sizeof($veh);$i++){
                            ?>
                            <option value="<?php echo $veh[$i]['idVehiculo']; ?>"><?php echo $veh[$i]['Placa']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cargue PDF de la licencia:</label>
                        <input type="file" name="filelicencia" class="form-control w-50">
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="registrar" value="Registrar" class="btn btn-dark w-50">
                    </div>
                    </form>
                </div>
        </center>
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
    $condc=$cond->queryconductor($_POST['idcond']);  
    if(sizeof($condc)==0)
    {
        $files[]=$_FILES;
        $inf[]=$_POST;
        $con=$cond->InsertCondut($inf);    
    }else
    {
        echo "<script type='text/javascript'>
        alert('El usuario que intenta registrar ya exite');
        window.location='../CambulosMantenimiento/crudconductor.php';
        </script>";
    }
}
?>