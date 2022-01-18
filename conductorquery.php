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
if(isset($_POST['condoc']))
{
    if($_POST['consulta']==1)
    {
        $id=$_POST['doc'];
        $quer=$query->queryconductor($id);
        if(sizeof($quer)=="")
        {
            echo "<script type='text/javascript'>
                alert('El documento de identificacion no esta registrado');
                window.location='../CambulosMantenimiento/conductorquery.php';
                </script>";
        }
    }
    if($_POST['consulta']==2)
    {
        $nom=$_POST['doc'].'%';
        $quer=$query->queryconductorname($nom);
        if(sizeof($quer)=="")
        {
            echo "<script type='text/javascript'>
                alert('El nombre no esta registrado');
                window.location='../CambulosMantenimiento/conductorquery.php';
                </script>";
        }
    }
    if($_POST['consulta']=="")
    {
        echo "<script type='text/javascript'>
                alert('debe seleccionar el tipo de busqueda');
                window.location='../CambulosMantenimiento/conductorquery.php';
                </script>";
    }
}
if(isset($_POST['congeneral']))
{
    $quer=$query->queryallconductor();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Consulta conductor</title>
    <!--<link rel="stylesheet" href="style">
    <link rel="stylesheet" href="css/estilo.css">-->
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <?php require('partials/navadmin.php'); ?>
    <center>
        <br>
    <div class="container">
        <div class="card-footer text-muted bg-dark">
            <div class="card-header">
            <h1>CONSULTA CONDUCTORES</h1>
            </div>
            <div class="card-footer text-muted bg-dark">
                <form method="POST">
                <div class="mb-3 ">
                    <input type="text" name="doc" placeholder="Digtite nombre o ducumento" class="form-control w-50">
                </div>

                <div class="form-check">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Por identificacion
                        <input class="form-check-input" type="radio" name="consulta" value="1" id="flexRadioDefault1">
                    </label>
                </div>
                <div class="form-check">
                    
                    <label class="form-check-label" for="flexRadioDefault2">
                        Por nombre
                        <input class="form-check-input" type="radio" name="consulta" value="2" id="flexRadioDefault2" checked>
                    </label>
                </div>
                <input type="submit" name="condoc" value="Buscar" class="btn btn-dark">   
                <input type="submit" name="congeneral" value="Ver todos los conductores" class="btn btn-dark">
                </form>
            </div>
        </div>
    </div>
    </div>
    
    <div class="container">
        <hr>
        <div class="div">
            <table class="table table-striped table-hover">
                <thead class="thead">
                    <th scope="col">Identificacion</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Categoria licencia</th>
                    <th scope="col">Fecha vencimiento</th>
                    <th scope="col">Ver licencia</th>
                    <th scope="col">Vehiculo</th>
                    <th scope="col">Modificar</th>
                    <th scope="col">Eliminar</th>
                </thead>
                <?php
                if(isset($_POST['condoc']) or(isset($_POST['congeneral'])))
                {
                    for($i=0;$i<sizeof($quer);$i++)
                    {
                ?>
                <tr>
                    <td scope="row"><?php echo $quer[$i]['idConductor']?></td>
                    <td scope="row"><?php echo $quer[$i]['Nombre']?></td>
                    <td scope="row"><?php echo $quer[$i]['Apellido']?></td>
                    <td scope="row"><?php echo $quer[$i]['TelelfonoConductor']?></td>
                    <td scope="row"><?php echo $quer[$i]['CategoLicencia']?></td>
                    <td scope="row"><?php echo $quer[$i]['VenceLicencia']?></td>
                    <td scope="row"><a href="<?php echo $quer[$i]['archlicencia'];?>">ver</a></td>
                    <td scope="row"><?php echo $quer[$i]['Placa']?></td>
                    <td scope="row"><?php echo'<a href=conductorupdate.php?id='.$id=$quer[$i]['idConductor'].'>'; ?><img src="img/editar usuario.png" alt="Editar usuario" width="30"></a></td>
                    <td scope="row"><?php echo'<a href=conductordelete.php?id='.$id=$quer[$i]['idConductor'].'>'; ?><img src="img/eliminar usuario.png" alt="Eliminar usuario" width="30"></a></td>
                </tr>
                <?php
                }
                }
                ?>
            </table>
        </div>
    </div>
    </center>
    <br>
    <?php require('partials/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
<?php
?>