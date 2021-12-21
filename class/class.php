<?php 
require("conexion.php");
class conductor extends Conexion
{
    private $querycond=array();
    private $querycon=array();
    private $queryco=array();

    public function queryconductor($id)
    {
        $sql="CALL conductorquery(:id)";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array('id'=>$id));
        while($res=$rest->fetch(PDO::FETCH_ASSOC))
        {
            $this->querycon[]=$res;
        }
        return $this->querycon;
    }
    public function InsertCondut($inf)
    {
        $formato[]=('.pdf');
        $namefile= $_FILES['filelicencia']['name'];
        $nameTmpfile=$_FILES['filelicencia']['tmp_name'];
        $ext=substr($namefile, strrpos($namefile,'.'));
        if (in_array($ext,$formato))
        {
            if(move_uploaded_file($nameTmpfile,"documentos/cedula/".' '.$inf[0]['idcond'].' '.$inf[0]['nom'].' '.$inf[0]['ape'].'.pdf'))
            {   
            }
        }else{
            echo "<script type='text/javascript'>
                alert('ERROR El archivo que esta cargando debe ser PDF');
                window.location='../CambulosMantenimiento/crudconductor.php';
                </script>";
        }
        $ruta="documentos/cedula/$namefile";
        $id=$inf[0]['idcond'];
        $nom=$inf[0]['nom'];
        $ap=$inf[0]['ape'];
        $tel=$inf[0]['tel'];
        $cat=$inf[0]['categolicencia'];
        $date=$inf[0]['vencelicencia'];
        $file=$ruta;
        $veh=$inf[0]['vehiculo'];

        if($id=="" or($nom=="") or($ap=="") or($tel=="") or($cat=="") or($date=="") or($file=="") or($veh=="") )
            {
                echo "<script type='text/javascript'>
                alert('Debe diligenciar todos los campos');
                window.location='../CambulosMantenimiento/crudconductor.php';
                </script>";
            }else
            {
               
                $sql="CALL inserconductor(:id, :nom, :ap, :tel, :cat, :date, :file, :veh)";
                $rest=$this->conex->prepare($sql);
                $rest->execute(array('id'=>$id, 'nom'=>$nom, 'ap'=>$ap, 'tel'=>$tel, 'cat'=>$cat, 'date'=>$date, 'file'=>$file, 'veh'=>$veh,));
                echo "<script type='text/javascript'>
                alert('Registro realizado exitosamente');
                window.location='../CambulosMantenimiento/crudconductor.php';
                </script>";
            }
    }
}
class Vehiculo extends Conexion
{
    private $query=array();
    private $quer=array();
    private $que=array();

    public function queryvehiculo()
    {
        $sql="CALL vehiculoquery()";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array());
        while($res=$rest->fetch(PDO::FETCH_ASSOC))
        {
            $this->query[]=$res;
        }
        return $this->query;
    }

}

?>