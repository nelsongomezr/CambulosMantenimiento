<?php
$mysqli=new mysqli("localhost","root","","manteniemientocambulos");
$salida="";
$query="SELECT * FROM conductor WHERE conductor.estado=1 ORDER BY conductor.Nombre ASC";

if(isset($_POST['consulta'])){
    $info=$mysqli->real_escape_string($_POST['consulta']);
    $query="SELECT * FROM conductor WHERE conductor.estado=1 AND (conductor.Nombre LIKE '%".$info."%' OR conductor.Apellido LIKE '%".$info."%' or conductor.idConductor LIKE '%".$info."%') ORDER BY conductor.Nombre ASC";
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
        $id=$fila['idConductor'];
        $salida.="<tr>
                    <td scope='row'>".$fila['idConductor']."</td>
                    <td scope='row'>".$fila['Nombre']."</td>
                    <td scope='row'>".$fila['Apellido']."</td>
                    <td scope='row'><a href=infoconductor.php?id=".$fila['idConductor'].'>'."Ver mas</a></td>
                    <td scope='row'><a href=conductorupdate.php?id=".$fila['idConductor'].'>'."<img src='img/editar usuario.png' alt='Editar usuario' width='30'></a></td>
                    <td scope='row'><a href=conductordelete.php?id=".$fila['idConductor'].'>'."<img src='img/eliminar usuario.png' alt='Eliminar usuario' width='30'></a><td>
                    </tr>";

    }
    $salida.="</tbody></table>";
}else{
    echo "<center><h3>No se encontraron coincidencias</h3></center>";
}
echo $salida;
$mysqli->close();
?>
