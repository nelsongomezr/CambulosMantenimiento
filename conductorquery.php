<?php
require('class/class.php');
$query=new conductor;
if(isset($_POST['condoc']))
{
    $id=$_POST['doc'];
    $quer=$query->queryconductor($id);
    print_r($quer);
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
                <input type="number" name="doc" placeholder="Ingrese el documento" class="bottom1">
                <input type="submit" name="condoc" value="Buscar" class="bottom1"><br><br>
                <input type="submit" name="congeneral" value="Ver todos los conductores" class="bottom1">
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
                    <td><a href="echo <?php $quer[$i]['archlicencia']?>">ver</a></td>
                    <td><?php echo $quer[$i]['Placa']?></td>
                    <td><?php echo'<a href=conductorupdate.php?id='.$id.'>'; ?><img src="img/editar usuario.png" alt="Editar usuario" width="30"></a></td>
                    <td><a><img src="img/eliminar usuario.png" alt="Eliminar usuario" width="30"></a></td>
                </tr>
                <?php
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