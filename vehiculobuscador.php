<?php
$mysqli=new mysqli("localhost","root","","manteniemientocambulos");
$salida="";
$query="SELECT * FROM vehiculo
    INNER JOIN marca
    ON vehiculo.Marca_Idmarca=marca.idMarca 
    INNER JOIN usovheiculo
    ON vehiculo.UsoVheiculo_IdUso=usovheiculo.IdUso
    WHERE vehiculo.Estado=1 ORDER BY vehiculo.Placa ASC";

if(isset($_POST['consulta'])){
    $info=$mysqli->real_escape_string($_POST['consulta']);
    $query="SELECT * FROM vehiculo 
    INNER JOIN marca
    ON vehiculo.Marca_Idmarca=marca.idMarca
    INNER JOIN usovheiculo
    ON vehiculo.UsoVheiculo_IdUso=usovheiculo.IdUso
    WHERE vehiculo.Estado=1 AND (vehiculo.Placa LIKE '%".$info."%') ORDER BY vehiculo.Placa ASC";
}
$resultado=$mysqli->query($query);
if($resultado->num_rows >0)
{
    $salida.="<table class='table table-striped table-hover table-sm'>
    <thead  class='thead'>
        <th scope='col'>Placa</th>
        <th scope='col'>Marca</th>
        <th scope='col'>Actividad</th>
        <th scope='col'>informacion completa</th>
        <th scope='col'>Modificar</th>
        <th scope='col'>Eliminar</th>
    </thead>
    <tbody>";
    while($fila=$resultado->FETCH_ASSOC()){
        $id=$fila['idVehiculo'];
        $salida.="<tr>
        <td scope='row'>".$fila['Placa']."</td>
        <td scope='row'>".$fila['NombreMarca']."</td>
        <td scope='row'>".$fila['UsoVheiculocol']."</td>     
        <td scope='row'><a href=vehiculoinfo.php?id=".$fila['Placa'].'>'."ver mas</a></td>
        <td scope='row'><a href=vehiculoupdate.php?id=".$fila['Placa'].'>'."<img src='img/editar usuario.png' alt='Editar usuario' width='30'></a></td>
        <td scope='row'><a href=vehiculodelete.php?id=".$fila['Placa'].'>'."<img src='img/eliminar usuario.png' alt='Eliminar usuario' width='30'></a></td>
        </tr>";
        
    }
    $salida.="</tbody></table>";
}else{
    echo "<center><h3>No se encontraron coincidencias</h3></center>";
}
echo $salida;
$mysqli->close();
?>
