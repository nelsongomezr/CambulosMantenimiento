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
$nav=new rol;
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
    <?php $na=$nav->navrol($_SESSION['rol']) ?>
    
    <br>
    <center><h1>REGISTRO CONDUCTORES</h1></center> <BR>
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
                    <input type="number" name="idcond" placeholder="Documento identificacion" class="form-control">
                </label>
                <label class="form-label"><b>Nombres</b><br>
                    <input type="text" name="nom" placeholder="Ingrese los nombres" class="form-control">
                </label>
                <label class="form-label"><b>Apellidos</b><br>
                        <input type="text" name="ape" placeholder="Ingrese los apellidos" class="form-control">
                </label>
                <label class="form-label"><b>Telefono</b><br>
                        <input type="tel" name="tel" placeholder="ingrese el telefono" class="form-control">
                </label>
            </div>
            <div class="accordion-body">
                <label class="form-label"><b>Fecha nacimiento</b><br>
                    <input type="date" name="edad" placeholder="Ingrese la edad" class="form-control">
                </label>
                <label class="form-label"><b>Tipo de contrato:</b><br>
                    <input type="text" name="tcon" class="form-control" placeholder="Ingrese el tipo de contrato">
                </label>
                <label class="form-label"><b>Años experiencia</b><br>
                    <input type="text" name="expe" class="form-control" placeholder="Ingrese años de experiencia">
                </label>
                <label class="form-label"><b>Asignar vehiculo</b>
                    <select name="vehiculo" class="form-select">
                        <option>Seleccione el vehiculo</option>
                        <?php
                            for($i=0;$i<sizeof($veh);$i++){
                        ?>
                        <option value="<?php echo $veh[$i]['idVehiculo']; ?>"><?php echo $veh[$i]['Placa']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </label>
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
                    <label class="form-label"><b>Categoria Licencia</b><br>
                        <input type="text" name="categolicencia" placeholder="Ingrese la categoria" class="form-control">
                    </label> 
                    <label class="form-label"><b>Fecha vencimiento licencia</b>
                        <input type="date" name="vencelicencia" class="form-control">
                    </label>
                    <label class="form-label"><b>Fecha inscripcion RUNT</b>
                        <input type="date" name="frunt" class="form-control">
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
                    <label class="form-label"><b>Licencia conduccion</b>
                        <input type="file" name="filelicencia" class="form-control" id="formFile">
                    </label>
                    <label class="form-label"><b>Formato autorizacion de descuento</b>
                        <input type="file" name="fileautdescuento" class="form-control" id="formFile">
                    </label>
                    <label class="form-label"><b>Formato apertura caja menor</b>
                        <input type="file" name="filecajamenor" class="form-control" id="formFile">
                    </label>
                    <label class="form-label"><b>Formato responsivo equipo movil</b>
                        <input type="file" name="fileequipomovil" class="form-control" id="formFile">
                    </label>
                </div>
            </div>
            
        </div>
        <br>
        <input type="submit" name="registrar" value="REGISTRAR" class="btn btn-dark w-50">
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