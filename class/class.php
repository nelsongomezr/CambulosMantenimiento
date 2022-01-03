<?php 
require("conexion.php");
class conductor extends Conexion
{
    private $querycond=array();
    private $querycon=array();
    private $queryco=array();
    public function queryconductorname($nom)
    {
        $sql="call conductorqueryname(:nom)";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array('nom'=>$nom));
        while($res=$rest->fetch(PDO::FETCH_ASSOC))
        {
            $this->queryco[]=$res;
        }
        return $this->queryco;
    }
    public function queryallconductor()
    {
        $sql="call queryallconductor()";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array());
        while($res=$rest->fetch(PDO::FETCH_ASSOC))
        {
            $this->querycond[]=$res;
        }
        return $this->querycond;
    }
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
            if(move_uploaded_file($nameTmpfile,"CambulosMantenimiento/documentos/licencia/".' '.$inf[0]['idcond'].' '.$inf[0]['nom'].' '.$inf[0]['ape'].'.pdf'))
            {   
            }
        }else{
            echo "<script type='text/javascript'>
                alert('ERROR El archivo que esta cargando debe ser PDF');
                window.location='../CambulosMantenimiento/crudconductor.php';
                </script>";
        }
        //$ruta="documentos/licencia/".' '.$inf[0]['idcond'].' '.$inf[0]['nom'].' '.$inf[0]['ape'].'.pdf';
        $ruta="documentos/licencia/".' '.$inf[0]['idcond'].' '.$inf[0]['nom'].' '.$inf[0]['ape'].'.pdf';
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
                /*echo "<script type='text/javascript'>
                alert('Registro realizado exitosamente');
                window.location='../CambulosMantenimiento/crudconductor.php';
                </script>";*/
            }
    }
    public function updateconductor($update)
    {
       /*$formato[]=('.pdf');
        $namefile= $_FILES['filelicencia']['name'];
        $nameTmpfile=$_FILES['filelicencia']['tmp_name'];
        $ext=substr($namefile, strrpos($namefile,'.'));
        if (in_array($ext,$formato))
        {
            if(move_uploaded_file($nameTmpfile,"documentos/licencia/".' '.$update[0]['idcond'].' '.$update[0]['nom'].' '.$update[0]['ape'].'.pdf'))
            {   
            }
        }else{
            /*echo "<script type='text/javascript'>
                alert('ERROR El archivo que esta cargando debe ser PDF');
                window.location='../CambulosMantenimiento/conductorquery.php';
                </script>";*/
        //}
        //$ruta="documentos/licencia/".' '.$inf[0]['idcond'].' '.$inf[0]['nom'].' '.$inf[0]['ape'].'.pdf';
        print_r($update);
        $id=$update[0]['id'];
        $nom=$update[0]['nom'];
        $ap=$update[0]['ap'];
        $tel=$update[0]['tel'];
        $catlicen=$update[0]['catlicen'];
        $path="c/";
        $venlicen=$update[0]['venlicen'];
        $idveh=$update[0]['idveh'];
        $rol=$update[0]['rol'];

        if($id=="" or($nom=="") or($ap=="") or($tel=="") or($catlicen=="") or($venlicen=="") or($idveh=="") or($rol==""))
        {
            echo "<script type='text/javascript'>
                alert('Debe diligenciar todos campos');
                window.location='../CambulosMantenimiento/conductorquery.php';
                </script>";
        }else
        {
            $sql="call conductorupdate(:nom, :ap, :tel, :catlicen, :venlicen, :path, :idveh, :rol, :id)";
            $rest=$this->conex->prepare($sql);
            $rest->execute(array('id'=>$id, 'nom'=>$nom, 'ap'=>$ap, 'tel'=>$tel, 'catlicen'=>$catlicen, 'venlicen'=>$venlicen, 'path'=>$path, 'idveh'=>$idveh, 'rol'=>$rol));

            /*echo "<script type='text/javascript'>
                alert('Se actualizo la informaciuon correctamente');
                window.location='../CambulosMantenimiento/conductorquery.php';
                </script>";*/
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