<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Registro conductores</title>
</head>
<body>
    <div class="container">
    <center>
        <h1>REGISTRO CONDUCTORES</h1>
        <table>
            <form method="POST" class="color1">
                <tr><td>Documento de Identidad: </td><td><input type="number" name="idcond" placeholder="Documento identificacion" class="inp"></td></tr>
                <tr><td>Nombres: </td><td><input type="text" name="nom" placeholder="Ingrese los nombres" class="inp"></td></tr>
                <tr><td>Apellidos: </td><td><input type="text" name="ape" placeholder="Ingrese los apellidos" class="inp"></td></tr>
                <tr><td>Telefono: </td><td><input type="tel" name="tel" placeholder="ingrese el telefono" class="inp"></td></tr>
                <tr><td>Categoria Licencia: </td><td><input type="text" name="categolicencia" placeholder="Ingrese la categoria" class="inp"></td></tr>
                <tr><td>Fecha vencimiento licencia: </td><td><input type="date" name="vencelicencia" class="inp"></td></tr>
                <tr><td>Cargue PDF de la licencia: </td><td><input type="file" name="archlicencia" class="inp"></td></tr>
                <tr>
                    <td>Asignar el vehiculo</td>
                    <td>
                        <select name="vehiculo" class="inp">
                            <option>Seleccione el vehiculo</option>
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