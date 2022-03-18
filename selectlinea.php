
<?php
$mysqli=new mysqli("localhost","root","","manteniemientocambulos");
$salida="";


if(isset($_POST['consulta'])){
    $info=$mysqli->real_escape_string($_POST['consulta']);
    $query="SELECT * FROM linea WHERE linea.Marca_IdMarca=".$info." ORDER BY linea.NombreLinea ASC";
}
$resultado=$mysqli->query($query);
if($resultado->num_rows >0)
{
    while($fila=$resultado->FETCH_ASSOC()){
        $salida.="<option value='".$fila['IdLinea']."'>".$fila['NombreLinea'];
    }
    $salida.="</option>";
}else{
    //echo "<center><h3>No se encontro el usuario</h3></center>";
}
echo $salida;
$mysqli->close();
?>