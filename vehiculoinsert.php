<?php
require("class/class.php");
$vehiculo= new Vehiculo;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/estilo.css"?20220107>
    <title>Registro vehiculos</title>
</head>
<body>

<div class="div">
    <center>
    <H1>REGISTRO DE VEHICULOS</H1>

        <form method="POST" class="form2">
        <table>
            <tr>
            <tr><td colspan="4"><hr></td></tr>
            <tr><td colspan="4" align="center"><H3>INFORMACION GENRAL</H3></td></tr>
            <tr><td colspan="4"><hr></td></tr>
            </tr>
            <tr>
                <td>MARCA:</td><td><input type="text" name="marca" placeholder="" class="inp"></td>
                <td>PLACA:</td><td><input type="text" name="placa" placeholder="" class="inp"></td>
            </tr>
            <tr>
                <td>LINEA:</td><td><input type="text" name="linea" placeholder=""  class="inp"></td>
                <td>MODELO:</td><td><input type="text" name="modelo" placeholder="" class="inp"></td>
            </tr>
            <tr>
                <td>COLOR:</td><td><input type="text" name="color" placeholder="" class="inp"></td>
                <td>SERVICIO</td><td><input type="text" name="servicio" placeholder="" class="inp"></td>
            </tr>            
            <tr>
                <td>CLASE VEHICULO:</td><td><input type="text" name="clase" placeholder="" class="inp" ></td>
                <td>TIPO CARROCERIA:</td><td><input type="text" name="carroceria" placeholder="" class="inp" ></td>
            </tr>
            <tr>
                <td>CAPACIDAD DE CARGA:</td><td><input type="text" name="carga" placeholder="" class="inp" ></td>
                <td>PESO BRUTO</td><td><input type="text" name="peso" placeholder="" class="inp"></td>
            </tr>
            <tr>
                <td>TIPO DE DIRECCION:</td><td><input type="text" name="direccion" placeholder=""  class="inp"></td>
                <td>NUMERO DE CHASIS:</td><td><input type="text" name="nrochasis" placeholder="" class="inp" ></td>
            </tr>
            <tr>
                <td>NUMERO DE VIM:</td><td><input type="text" name="vim" placeholder="" class="inp"></td>
                <td>ACTIVIDAD:</td>
                <td>
                    <select name="actividad" class="sel">
                        <option value="ABONO">TIPO DE ACTIVIDAD</option>
                        <option value="ABONO">ABONO</option>
                        <option value="ADMINISTRATIVO">ADMINISTRATIVO</option>
                        <option value="ALIMENTO">ALIMENTO</option>
                        <option value="APOYO">APOYO</option>
                        <option value="CERDOS">CERDOS</option>
                        <option value="DESECHOS">DESECHOS</option>
                        <option value="HUEVO">HUEVO</option>
                        <option value="POLLITO">POLLITO</option>
                        <option value="VOLQUETA">VOLQUETA</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>FECHA MATRICULA:</td><td><input type="date" name="fmatricula" placeholder="" class="inp"></td>
            </tr>
            <tr><td colspan="4"><hr></td></tr>
            <tr><td colspan="4" align="center"><h3>DIMENSIONES</h3></td></tr>
            <tr><td colspan="4"><hr></td></tr>
            <tr>
                <td>NUMERO DE EJES:</td><td><input type="text" name="ejes" placeholder="" class="inp"></td>
                <td>LONGITUD TOTAL (MM):</td><td><input type="text" name="longitud" placeholder="" class="inp"></td>
            </tr>
            <tr>
                <td>ALTO (MM):</td><td><input type="text" name="alto" placeholder="" class="inp"></td>
                <td>ANCHO (MM):</td><td><input type="text" name="ancho" placeholder="" class="inp"></td>
            </tr>
            <tr>
                <td>DIST. ENTRE EJES (MM):</td><td><input type="text" name="distejes" placeholder="" class="inp"></td>
            </tr>
            <tr><td colspan="4"><hr></td></tr>
            <tr><td colspan="4" align="center"><h3>MOTOR</h3></td></tr>
            <tr><td colspan="4"><hr></td></tr>
            <tr>
            <td>CILINDRAJE (CM³):</td><td><input type="text" name="cilindraje" placeholder="" class="inp"></td>
                <td>TIPO COMBUSTIBLE</td><td><input type="text" name="combustible" placeholder="" class="inp"></td>
            </tr>
            <tr>
                <td>NÚMERO DE MOTOR:</td><td><input type="text" name="nromotor" placeholder="" class="inp"></td>
            </tr>
            <tr><td colspan="4"><hr></td></tr>
            <tr><td colspan="4" align="center"><h3>LLANTAS</h3></td></tr>
            <tr><td colspan="4"><hr></td></tr>
            <tr>
                <td>NUMERO DE LLANTAS:</td><td><input type="text" name="nrollantas" placeholder="" class="inp"></td>
                <td>DIMENSION LLANATA:</td><td><input type="text" name="dllantas" placeholder="" class="inp"></td>
            </tr>
            <tr><td colspan="4"><hr></td></tr>
            <tr><td colspan="4" align="center"><h3>DOCUMENTACION</h3></td></tr>
            <tr><td colspan="4"><hr></td></tr>
            <tr><td ><h4>SOAT</h4></td></tr>
            <tr><td>POLIZA:</td><td><input type="text" name="nropolizasoat" placeholder="" class="inp"></td></tr>
            <tr><td>FECHA VENCIMIENTO:</td><td><input type="date" name="fechasoat" placeholder=""class="inp" ></td></tr>
            <tr><td>SUBIR PDF SOAT:</td><td><input type="file" name="filesoat" placeholder="" class="inp"></td></tr>
            <tr><td colspan="4"><hr></td></tr>

            <tr><td ><h4>TECNICO MECANICA</h4></td></tr>
            <tr>
                <tr><td>NRO REVISION:</td><td><input type="text" name="nrorevision" placeholder="" class="inp"></td></tr>
                <tr><td>FECHA VENCIMIENTO:</td><td><input type="date" name="fecharevision" placeholder="" class="inp"></td></tr>
                <tr><td>SUBIR PDF REVISION:</td><td><input type="file" name="filerevision" placeholder="" class="inp"></td></tr>
            </tr>
            <tr><td colspan="4"><hr></td></tr>

            <tr><td ><h4>LICENCIA DE TRANSITO:</h4></td></tr>
            <tr>
                <tr><td>NRO DE LICENCIA TRANSITO:</td><td><input type="text" name="nroltransito" placeholder="" class="inp"></td></tr>
                <tr><td>FECHA VENCIMIENTO:</td><td><input type="date" name="fechaltransito" placeholder="" class="inp"></td></tr>
                <tr><td>SUBIR PDF LICENCIA TRANSITO:</td><td><input type="file" name="fileltransito" class="inp" placeholder="" class="btn btn-success"></td></tr>
            </tr>
            <tr><td colspan="4"><hr></td></tr>
            <tr>
                <td><input type="submit" name="enviar" value="REGISTRAR VEHICULO" class="bottom-2"></td>
            </tr>
            </table>
        </form>
    
    </center>
</div>
</body>
</html>
<?php
    if(isset($_POST['enviar']))
    {
        $info[]=$_POST;
        $inst=$vehiculo->insertvehiculo($info);
    }

    $a=12345;
    echo $aa=crypt(10,$a);

?>