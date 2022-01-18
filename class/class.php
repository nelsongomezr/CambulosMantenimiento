<?php 
require("conexion.php");
class login extends Conexion
{
    private $info=array();
    public function log($info)
    {
        if($info[0]['usuario']=="" or($info[0]['pass']==""))
        {
            echo "<script type='text/javascript'>
            alert('Debe diligenciar todos los campos');
            window.location='index.php';
            </script>";
        }
        else{
            $querycond= new conductor;
            $querycon=$querycond->queryconductor($info[0]['usuario']);
            if(sizeof($querycon)==0)
            {
                session_start();
                $_SESSION['USUARIO']=$info[0]['usuario'];
                $queryuser= new user;
                $queryuse=$queryuser->queryuser($_SESSION['USUARIO']);
                if(sizeof($queryuse)>0)
                {
                    if($queryuse[0]['idUsuario']==$info[0]['usuario'] and $queryuse[0]['contrasena']==$info[0]['pass'] and $queryuse[0]['NombreRol']=="ADMINISTRATIVO")
                    {
                        header('location:homeadministrativo.php');
                    }elseif($queryuse[0]['idUsuario']==$info[0]['usuario'] and $queryuse[0]['contrasena']==$info[0]['pass'] and $queryuse[0]['NombreRol']=="ADMIN")
                    {
                        header('location:homeadmin.php');
                    }else
                    {
                        echo "<script type='text/javascript'>
                        alert('las credenciales no coinciden');
                        window.location='index.php';
                        </script>";
                    }
                }
            }else
            {
                if($querycon[0]['idConductor']==$info[0]['usuario'] and $querycon[0]['contrasena']==$info[0]['pass'] and $querycon[0]['NombreRol']=="CONDUCTOR")
                {
                    header('location:homeconductor.php');
                }else
                {
                    echo "<script type='text/javascript'>
                    alert('las credenciales no coinciden');
                    window.location='index.php';
                    </script>";
                }
                
            }
            

        }
        
    }
}
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
        $sql="call conductorquery(:id)";
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
            if(move_uploaded_file($nameTmpfile,"documentos/licencia/".' '.$inf[0]['idcond'].' '.$inf[0]['nom'].' '.$inf[0]['ape'].'.pdf'))
            {   
            }
        }else{
            echo "<script type='text/javascript'>
                alert('ERROR El archivo que esta cargando debe ser PDF');
                window.location='../CambulosMantenimiento/crudconductor.php';
                </script>";
        }
        $ruta="documentos/licencia/".' '.$inf[0]['idcond'].' '.$inf[0]['nom'].' '.$inf[0]['ape'].'.pdf';
        $id=$inf[0]['idcond'];
        $nom=$inf[0]['nom'];
        $ap=$inf[0]['ape'];
        $tel=$inf[0]['tel'];
        $cat=$inf[0]['categolicencia'];
        $date=$inf[0]['vencelicencia'];
        $file=$ruta;
        $veh=$inf[0]['vehiculo'];
        $ed=$inf[0]['edad'];
        $tcon=$inf[0]['tcon'];
        $aexp=$inf[0]['expe'];
        $daterunt=$inf[0]['frunt'];

        if($id=="" or($nom=="") or($ap=="") or($tel=="") or($cat=="") or($date=="") or($file=="") or($veh=="") or($ed=="") or($tcon=="") or($aexp=="") or($daterunt==""))
            {
                echo "<script type='text/javascript'>
                alert('Debe diligenciar todos los campos');
                window.location='../CambulosMantenimiento/crudconductor.php';
                </script>";
            }else
            {                             
                $sql="CALL inserconductor(:id, :nom, :ap, :tel, :cat, :date, :file, :veh, :ed, :tcon, :aexp, :daterunt)";
                $rest=$this->conex->prepare($sql);
                $rest->execute(array('id'=>$id, 'nom'=>$nom, 'ap'=>$ap, 'tel'=>$tel, 'cat'=>$cat, 'date'=>$date, 'file'=>$file, 'veh'=>$veh, 'ed'=>$ed, 'tcon'=>$tcon, 'aexp'=>$aexp, 'daterunt'=>$daterunt));
                echo "<script type='text/javascript'>
                alert('Registro realizado exitosamente');
                window.location='../CambulosMantenimiento/crudconductor.php';
                </script>";
            }
    }
    public function updateconductor($update)
    {
        $formato[]=('.pdf');
        $namefile= $_FILES['cargue']['name'];
        $nameTmpfile=$_FILES['cargue']['tmp_name'];
        $ext=substr($namefile, strrpos($namefile,'.'));
        if (in_array($ext,$formato))
        {
            if(move_uploaded_file($nameTmpfile,"documentos/licencia/".' '.$update[0]['id'].' '.$update[0]['nom'].' '.$update[0]['ap'].'.pdf'))
            {   
            }
        }
            
        $ruta="documentos/licencia/".' '.$update[0]['id'].' '.$update[0]['nom'].' '.$update[0]['ap'].'.pdf';     
        $id=$update[0]['id'];
        $nom=$update[0]['nom'];
        $ap=$update[0]['ap'];
        $tel=$update[0]['tel'];
        $cat=$update[0]['catlicen'];
        $flicen=$update[0]['venlicen'];
        $frunt=$update[0]['frunt'];
        $ed=$update[0]['edad'];
        $tcon=$update[0]['tcon'];
        $aexp=$update[0]['expe'];
        $rol=$update[0]['rol'];
        $idveh=$update[0]['idveh'];

        if($id=="" or($nom=="") or($ap=="") or($tel=="") or($cat=="") or($flicen=="") or($frunt=="") or($ed=="") or($tcon=="") or($aexp=="") or($rol=="") or($idveh=="") )
        {
            echo "<script type='text/javascript'>
            alert('Debe diligenciar todos los campos');
            window.location='../CambulosMantenimiento/conductorquery.php';
            </script>";
        }else
        {
            $sql="UPDATE conductor 
            SET 
            conductor.idConductor=:id,
            conductor.Nombre=:nom,
            conductor.Apellido=:ap,
            conductor.TelelfonoConductor=:tel,
            conductor.CategoLicencia=:cat,
            conductor.VenceLicencia=:flicen,
            conductor.archlicencia=:files,
            conductor.Vehiculo_idVehiculo=:idveh,
            conductor.Rol_idRol=:rol,
            conductor.estado=1,
            conductor.Edad=:ed,
            conductor.TipoContrato=:tcon,
            conductor.ExpConduccion=:expe,
            conductor.InscripRUNT=:frunt 
            WHERE conductor.idConductor=:id";
            
            $rest=$this->conex->prepare($sql);
            $rest->execute(array('id'=>$id, 'nom'=>$nom, 'ap'=>$ap, 'tel'=>$tel, 'cat'=>$cat,
            'flicen'=>$flicen, 'files'=>$ruta, 'idveh'=>$idveh, 'rol'=>$rol, 'ed'=>$ed, 'tcon'=>$tcon, 'expe'=>$aexp, 'frunt'=>$frunt));
            echo "<script type='text/javascript'>
            alert('Informacion actualizada correctamente.');
            window.location='../CambulosMantenimiento/conductorquery.php';
            </script>";
        }
        
    }
    public function deleteconductor($id)
    {
        
        $sql="CALL conductordelete(:id)";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array('id'=>$id));
        echo "<script type='text/javascript'>
                alert('Registro eliminado exitosamente');
                window.location='../CambulosMantenimiento/conductorquery.php';
                </script>";
    }
    
}

class Vehiculo extends Conexion
{
    private $queryvehi=array();
    private $querveh=array();
    private $queve=array();

    public function queryvehiculo()
    {
        $sql="CALL vehiculoquery()";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array());
        while($res=$rest->fetch(PDO::FETCH_ASSOC))
        {
            $this->queryvehi[]=$res;
        }
        return $this->queryvehi;
    }
    public function insertvehiculo($info)
    {
        print_r($info);
        

    }
}
class user extends Conexion
{
    private $use=array();
    private $us=array();
    private $u=array();
    
    public function queryuser($id)
    {
        $sql="SELECT * FROM `usuario` INNER JOIN rol ON USUARIO.Rol_idRol=rol.idRol WHERE usuario.idUsuario=:id";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array('id'=>$id));
        while($res=$rest->fetch(PDO::FETCH_ASSOC))
        {
            $this->use[]=$res;
        }
        return $this->use;
    }
}

?>