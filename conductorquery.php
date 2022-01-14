<?php
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
    <title>Consulta conductor</title>
    <link rel="stylesheet" href="style">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <center>
    <div class="row">
            <h1>CONSULTA CONDUCTORES</h1>
            <form method="POST">
                <input type="text" name="doc" placeholder="Digtite nombre o ducumento" class="inp"><br>
                Por identificacion: <input type="radio" name="consulta" value="1">
                Por nombre:         <input type="radio" name="consulta" value="2"><br>
                <input type="submit" name="condoc" value="Buscar" class="bottom">   
                <input type="submit" name="congeneral" value="Ver todos los conductores" class="bottom">
            </form>
    </div>
    
    <div class="container">
        <hr>
        <div class="div">
            <table class="table">
                <thead class="thead">
                    <th>Identificacion</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Categoria licencia</th>
                    <th>Fecha vencimiento</th>
                    <th>Ver licencia</th>
                    <th>Vehiculo</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </thead>
                <?php
                if(isset($_POST['condoc']) or(isset($_POST['congeneral'])))
                {
                    for($i=0;$i<sizeof($quer);$i++)
                    {
                ?>
                <tr>
                    <td><?php echo $quer[$i]['idConductor']?></td>
                    <td><?php echo $quer[$i]['Nombre']?></td>
                    <td><?php echo $quer[$i]['Apellido']?></td>
                    <td><?php echo $quer[$i]['TelelfonoConductor']?></td>
                    <td><?php echo $quer[$i]['CategoLicencia']?></td>
                    <td><?php echo $quer[$i]['VenceLicencia']?></td>
                    <td><a href="<?php echo $quer[$i]['archlicencia'];?>">ver</a></td>
                    <td><?php echo $quer[$i]['Placa']?></td>
                    <td><?php echo'<a href=conductorupdate.php?id='.$id=$quer[$i]['idConductor'].'>'; ?><img src="img/editar usuario.png" alt="Editar usuario" width="30"></a></td>
                    <td><?php echo'<a href=conductordelete.php?id='.$id=$quer[$i]['idConductor'].'>'; ?><img src="img/eliminar usuario.png" alt="Eliminar usuario" width="30"></a></td>
                </tr>
                <?php
                }
                }
                ?>
            </table>
        </div>
    </div>
    </center>
</body>
</html>
<?php
?>