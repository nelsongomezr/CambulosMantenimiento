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
$nav= new rol;
$contrato=$query->querycontrato();
$catlicencia=$query->querycategorialicencia();
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
    <?php $na=$nav->navrol($_SESSION['rol']) ?>
    <br>
    <center><h1>ACTUALIZACION DATOS CONDUCTOR</h1></center>
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
                    <input type="number" name="id"  class="form-control" value="<?php echo $quer[0]['idConductor'];?>">
                </label>
                <label class="form-label"><b>Nombres</b><br>
                    <input type="text" name="nom"  class="form-control" value="<?php echo $quer[0]['Nombre'];?>">
                    
                </label>
                <label class="form-label"><b>Apellidos</b><br>
                        <input type="text" name="ap" class="form-control" value="<?php echo $quer[0]['Apellido'];?>">
                </label>
                <label class="form-label"><b>Telefono</b><br>
                        <input type="tel" name="tel" class="form-control" value="<?php echo $quer[0]['TelelfonoConductor'];?>">
                </label>
            </div>
            <div class="accordion-body">
                <label class="form-label"><b>Fecha nacimiento</b><br>
                    <input type="date" name="edad" class="form-control" value="<?php echo $quer[0]['Edad'];?>">
                </label>
                <label class="form-label"><b>Tipo de contrato:</b><br>
                    <select name="tcon" class="form-select">
                        <option value="<?php echo $quer[0]['IdContrato']?>"><?php echo $quer[0]['Contrato']?> Contrato actual</option>
                        <?php foreach($contrato as $cont){?>
                            <option value="<?php echo $cont['IdContrato'];?>"><?php echo $cont['Contrato'];?></option>
                        <?php }?>
                    </select>
                </label>
                <label class="form-label"><b>Años experiencia</b><br>
                    <input type="text" name="expe" class="form-control" value="<?php echo $quer[0]['ExpConduccion'];?>">
                </label>
                <label class="form-label"><b>Asignar vehiculo</b>
                    <select name="idveh" class="form-select">
                        <option value="<?php echo $quer[0]['idVehiculo']?>"><?php echo $quer[0]['Placa']?> Vehiculo actual</option>
                        <?php
                            for($i=0;$i<sizeof($queryv);$i++){
                        ?>
                        <option value="<?php echo $queryv[$i]['idVehiculo'];?>"><?php echo $queryv[$i]['Placa'];?></option>
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
                        <select name="catlicen" class="form-select">
                            <option value="<?php echo $quer[0]['IdTipoLicencia']?>"> <?php echo $quer[0]['TipoLicencia']?> Categoria actual</option>
                            <?php foreach($catlicencia as $cat){ ?>
                                <option value="<?php echo $cat['IdTipoLicencia'];?>"><?php echo $cat['TipoLicencia'];?></option>
                            <?php }?>
                        </select>
                    </label> 
                    <label class="form-label"><b>Fecha vencimiento licencia</b>
                        <input type="date" name="venlicen" class="form-control" value="<?php echo $quer[0]['VenceLicencia'];?>" class="form-control w-50">
                    </label>
                    <label class="form-label"><b>Fecha inscripcion RUNT</b>
                        <input type="date" name="frunt" class="form-control" value="<?php echo $quer[0]['InscripRUNT'];?>">
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
                        <input type="file" name="cargue" class="form-control" id="formFile" value="<?php echo $quer[0]['archlicencia']; ?>">
                    </label>
                    <label class="form-label"><b>Formato autorizacion de descuento</b>
                        <input type="file" name="fileautdescuento" class="form-control" id="formFile" value="<?php echo $quer[0]['ArchAutoDescuento']; ?>">
                    </label>
                    <label class="form-label"><b>Formato apertura caja menor</b>
                        <input type="file" name="filecajamenor" class="form-control" id="formFile" value="<?php echo $quer[0]['ArchAperturaCaja']; ?>">
                    </label>
                    <label class="form-label"><b>Formato responsivo equipo movil</b>
                        <input type="file" name="fileequipomovil" class="form-control" id="formFile" value="<?php echo $quer[0]['ArchEquipoMovil']; ?>">
                    </label>
                </div>
            </div>
        </div>
        <BR>
        <input type="hidden" name="rol" value="<?php echo $quer[0]['Rol_idRol']; ?>">
        <input type="submit" name="update" value="ACTUALIZAR" class="btn btn-dark w-50">
        
        </form>
        <br>
    </div>
    <?php
        require('partials/footer.php');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
<?php
print_r($_POST);
if(isset($_POST['update'])){
    $up=$query->updateconductor($_POST);
}
?>