<?php
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
    <link rel="stylesheet" href="style.css">
    <link rel="styleshheet" href="css/estilo.css">
    <title>Registro conductores</title>
</head>
<body>
    <div class="container">
    <center>
        <h1>REGISTRO CONDUCTORES</h1>
        <table>
            <form method="POST" enctype="multipart/form-data" class="form">
                <tr><td>Documento de Identidad: </td><td><input type="number" name="idcond" placeholder="Documento identificacion" class="inp"></td></tr>
                <tr><td>Nombres: </td><td><input type="text" name="nom" placeholder="Ingrese los nombres" class="inp"></td></tr>
                <tr><td>Apellidos: </td><td><input type="text" name="ape" placeholder="Ingrese los apellidos" class="inp"></td></tr>
                <tr><td>Telefono: </td><td><input type="tel" name="tel" placeholder="ingrese el telefono" class="inp"></td></tr>
                <tr><td>Categoria Licencia: </td><td><input type="text" name="categolicencia" placeholder="Ingrese la categoria" class="inp"></td></tr>
                <tr><td>Fecha vencimiento licencia: </td><td><input type="date" name="vencelicencia" class="inp"></td></tr>
                <tr><td>Fecha inscripcion RUNT </td><td><input type="date" name="frunt" class="inp"></td></tr>
                <tr><td>Edad: </td><td><input type="number" name="edad" class="inp"></td></tr>
                <tr><td>Tipo de Contrato: </td><td><input type="text" name="tcon" class="inp"></td></tr>
                <tr><td>Años experiencia: </td><td><input type="text" name="expe" class="inp"></td></tr>
                <tr><td>Cargue PDF de la licencia: </td><td><input type="file" name="filelicencia" class="inp"></td></tr>
                <tr>
                    <td>Asignar el vehiculo</td>
                    <td>
                        <select name="vehiculo" class="inp">
                            <option>Seleccione el vehiculo</option>
                            <?php
                                for($i=0;$i<sizeof($veh);$i++){
                            ?>
                            <option value="<?php echo $veh[$i]['idVehiculo']; ?>"><?php echo $veh[$i]['Placa']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr><td></td><td><input type="submit" name="registrar" value="Registrar" class="bottom"></td></tr>
            </form>
        </table>
    </center>
    </div>
</body>
</html>
<?php
if(isset($_POST['registrar']))
{
  //print_r($_POST);
    $condc=$cond->queryconductor($_POST['idcond']);  
    if(sizeof($condc)==0)
    {
        $files[]=$_FILES;
        $inf[]=$_POST;
        $con=$cond->InsertCondut($inf);    
    }else
    {
        echo "<script type='text/javascript'>
        alert('El conductor ya se encuentra registrado');
        window.location='../CambulosMantenimiento/crudconductor.php';
        </script>";
    }
}
?>