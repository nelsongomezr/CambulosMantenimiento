<?php
$mysqli=new mysqli("localhost","root","","manteniemientocambulos");
$salida="";
$query="SELECT * FROM usuario WHERE usuario.Estado=1 ORDER BY usuario.Nombre";

if(isset($_POST['consulta'])){
    $info=$mysqli->real_escape_string($_POST['consulta']);

    //$query="SELECT * FROM usuario WHERE usuario.Nombre LIKE '%".$info."%' OR usuario.Apellido LIKE '%".$info."%' or usuario.idUsuario LIKE '%".$info."%' ORDER BY usuario.Nombre ASC";
    $query="SELECT * FROM usuario WHERE usuario.Estado=1 AND (usuario.Nombre LIKE '%".$info."%' OR usuario.Apellido LIKE '%".$info."%' or usuario.idUsuario LIKE '%".$info."%') ORDER BY usuario.Nombre ASC";
}
$resultado=$mysqli->query($query);
if($resultado->num_rows >0)
{
    $salida.="<table class='table table-striped table-hover table-sm'>
    <thead class='thead'>
        <th scope='col'>Identificacion</th>
        <th scope='col'>Nombre</th>
        <th scope='col'>Apellido</th>
        <th scope='col'>informacion completa</th>
        <th scope='col'>Modificar</th>
        <th scope='col'>Eliminar</th>
    </thead>
    <tbody>";

    while($fila=$resultado->FETCH_ASSOC()){
        $id=$fila['idUsuario'];
        $salida.="<tr>
                    <td scope='row'>".$fila['idUsuario']."</td>
                    <td scope='row'>".$fila['Nombre']."</td>
                    <td scope='row'>".$fila['Apellido']."</td>
                    <td scope='row'><a href=userinfo.php?id=".$fila['idUsuario'].'>'."Ver mas</a></td>
                    <td scope='row'><a href=userupdate.php?id=".$fila['idUsuario'].'>'."<img src='img/editar usuario.png' alt='Editar usuario' width='30'></a></td>
                    <td scope='row'><a href=userdelete.php?id=".$fila['idUsuario'].'>'."<img src='img/eliminar usuario.png' alt='Eliminar usuario' width='30'></a><td>
                    </tr>";

    }
    $salida.="</tbody></table>";
}else{
    echo "<center><h3>No se encontraron concidencias</h3></center>";
}
echo $salida;
$mysqli->close();
?>
