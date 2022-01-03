<?php 
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
</head>
<body>
    <center>
        <div class="container">
            <h1>ACTUALIZACION DATOS CONDUCTOR</h1>
            <table>
            <form method="POST" enctype="multipart/form-data" class="form">
                <tr><td>Identificacion: </td><td><input type="text" name="id" value="<?php echo $quer[0]['idConductor'];?>" class="inp"></td></tr>
                <tr><td>Nonbres: </td><td><input type="text" name="nom" value="<?php echo $quer[0]['Nombre'];?>" class="inp"></td></tr>
                <tr><td>Apellidos: </td><td><input type="text" name="ap" value="<?php echo $quer[0]['Apellido'];?>" class="inp"></td></tr>
                <tr><td>Telefono: </td><td><input type="text" name="tel" value="<?php echo $quer[0]['TelelfonoConductor'];?>" class="inp"></td></tr>
                <tr><td>Categoria licencia</td><td><input type="text" name="catlicen" value="<?php echo $quer[0]['CategoLicencia'];?>" class="inp"></td></tr>
                <tr><td>Fecha vencimiento licencia</td><td><input type="text" name="venlicen" value="<?php echo $quer[0]['VenceLicencia'];?>" class="inp"></td></tr>
                <input type="hidden" name="rol" value="<?php echo $quer[0]['Rol_idRol']; ?>">
                <tr>
                    <td>Asignar vehiculo</td>  
                    <td>
                        <select name="idveh" class="sel">
                            <option>Seleccionar vehiculo</option>
                            <?php 
                            for($i=0;$i<sizeof($queryv);$i++){
                             ?>
                             <option value="<?php echo $queryv[$i]['idVehiculo'];?>"><?php echo $queryv[$i]['Placa'];?></option>
                             <?php 
                             }
                             ?>
                        </select>
                    </td>
                </tr>
                <tr><td>Cargue PDF de la licencia:</td><td><input type="file" name="path" value="" class="inp"></td></tr> 
               <tr><td></td><td><input type="submit" name="update" value="ACTUALIZAR" class="bottom"></td></tr>
            </form>
        </table>
        </div>
    </center>
</body>
</html>
<?php
if(isset($_POST['update'])){
    $update[]=$_POST;
    $que=$query->updateconductor($update);
}
?>