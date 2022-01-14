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
                <tr><td>Documento de Identidad: </td><td><input type="text" name="id" value="<?php echo $quer[0]['idConductor'];?>" class="inp"></td></tr>
                <tr><td>Nonbres: </td><td><input type="text" name="nom" value="<?php echo $quer[0]['Nombre'];?>" class="inp"></td></tr>
                <tr><td>Apellidos: </td><td><input type="text" name="ap" value="<?php echo $quer[0]['Apellido'];?>" class="inp"></td></tr>
                <tr><td>Telefono: </td><td><input type="text" name="tel" value="<?php echo $quer[0]['TelelfonoConductor'];?>" class="inp"></td></tr>
                <tr><td>Categoria licencia</td><td><input type="text" name="catlicen" value="<?php echo $quer[0]['CategoLicencia'];?>" class="inp"></td></tr>
                <tr><td>Fecha vencimiento licencia</td><td><input type="date" name="venlicen" value="<?php echo $quer[0]['VenceLicencia'];?>" class="inp"></td></tr>
                <tr><td>Fecha inscripcion RUNT </td><td><input type="date" name="frunt" value="<?php echo $quer[0]['InscripRUNT'];?>" class="inp"></td></tr>
                <tr><td>Edad: </td><td><input type="number" name="edad" value="<?php echo $quer[0]['Edad'];?>"  class="inp"></td></tr>
                <tr><td>Tipo de Contrato: </td><td><input type="text" name="tcon" value="<?php echo $quer[0]['TipoContrato'];?>" class="inp"></td></tr>
                <tr><td>Años experiencia: </td><td><input type="text" name="expe" value="<?php echo $quer[0]['ExpConduccion'];?>" class="inp"></td></tr>
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
                <tr><td>Cargue PDF de la licencia: </td><td><input type="file" name="cargue" class="inp"></td></tr>
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