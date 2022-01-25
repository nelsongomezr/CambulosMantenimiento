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
                    $pass=crypt(10,$info[0]['pass']);
                    if($queryuse[0]['idUsuario']==$info[0]['usuario'] and $queryuse[0]['contrasena']==$pass and $queryuse[0]['NombreRol']=="ADMINISTRATIVO")
                    {
                        $_SESSION['rol']=$queryuse[0]['NombreRol'];
                        header('location:homeadministrativo.php');
                    }elseif($queryuse[0]['idUsuario']==$info[0]['usuario'] and $queryuse[0]['contrasena']==$pass and $queryuse[0]['NombreRol']=="ADMIN")
                    {
                        $_SESSION['rol']=$queryuse[0]['NombreRol'];
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
                session_start();
                $_SESSION['USUARIO']=$info[0]['usuario'];
                $pass=crypt(10,$info[0]['pass']);
                if($querycon[0]['idConductor']==$info[0]['usuario'] and $querycon[0]['contrasena']==$pass and $querycon[0]['NombreRol']=="CONDUCTOR")
                {
                    $_SESSION['rol']=$querycon[0]['NombreRol'];
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
       $quercond= new conductor;
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
        $querc=$quercond->queryconductor($id);

        if($id=="" or($nom=="") or($ap=="") or($tel=="") or($cat=="") or($date=="") or($file=="") or($veh=="") or($ed=="") or($tcon=="") or($aexp=="") or($daterunt==""))
            {
                echo "<script type='text/javascript'>
                alert('Debe diligenciar todos los campos');
                window.location='../CambulosMantenimiento/crudconductor.php';
                </script>";

            }else
            {                             
                $pass=crypt(10,$id);
                $sql="CALL inserconductor(:id, :nom, :ap, :tel, :cat, :date, :file, :veh, :ed, :tcon, :aexp, :daterunt, :pass)";
                $rest=$this->conex->prepare($sql);
                $rest->execute(array('id'=>$id, 'nom'=>$nom, 'ap'=>$ap, 'tel'=>$tel, 'cat'=>$cat, 'date'=>$date, 'file'=>$file, 'veh'=>$veh, 'ed'=>$ed, 'tcon'=>$tcon, 'aexp'=>$aexp, 'daterunt'=>$daterunt, 'pass'=>$pass));
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
            $querycond= new  conductor;
            $Quercond=$querycond->queryconductor($id);
            print_r($Quercond);
            $rest=$this->conex->prepare($sql);
            $rest->execute(array('id'=>$id, 'nom'=>$nom, 'ap'=>$ap, 'tel'=>$tel, 'cat'=>$cat,
            'flicen'=>$flicen, 'files'=>$ruta, 'idveh'=>$idveh, 'rol'=>$rol, 'ed'=>$ed, 'tcon'=>$tcon, 'expe'=>$aexp, 'frunt'=>$frunt));
            $_SESSION['varid']=$Quercond[0]['idConductor'];
            echo "<script type='text/javascript'>
            alert('Informacion actualizada correctamente.');
            window.location='../CambulosMantenimiento/infoconductor.php ';
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

    public function insertvehiculo($info)
    {
        print_r($info).'<br>';
        print_r($_FILES);
        $formato[]=('.pdf');

        if(isset($_FILES['filesoat']))
        {
            $namefile= $_FILES['filesoat']['name'];
            $nameTmpfile=$_FILES['filesoat']['tmp_name'];
            $ext=substr($namefile, strrpos($namefile,'.'));
            if (in_array($ext,$formato))
            {
                if(move_uploaded_file($nameTmpfile,"documentos/vehiculo/soat/".' '.$info['placa'].' '.$info['nsoat'].' '.$info['fsoat'].'.pdf'))
                {   
                }
            }else{
                    /*echo "<script type='text/javascript'>
                    alert('ERROR El archivo que esta cargando debe ser PDF');
                    window.location='vehiculoinsert.php';
                    </script>";*/
            }
            $filesoat="documentos/vehiculo/soat/".' '.$info['placa'].' '.$info['nsoat'].' '.$info['fsoat'].'.pdf';
        }

        if(isset($_FILES['filetecnico']))
        {
            $namefile= $_FILES['filetecnico']['name'];
            $nameTmpfile=$_FILES['filetecnico']['tmp_name'];
            $ext=substr($namefile, strrpos($namefile,'.'));
            if (in_array($ext,$formato))
            {
                if(move_uploaded_file($nameTmpfile,"documentos/vehiculo/tecnicomecanica/".' '.$info['placa'].' '.$info['nsoat'].' '.$info['fsoat'].'.pdf'))
                {   
                }
            }else{
                    /*echo "<script type='text/javascript'>
                    alert('ERROR El archivo que esta cargando debe ser PDF');
                    window.location='vehiculoinsert.php';
                    </script>";*/
            }

            $filetecnico="documentos/vehiculo/tecnicomecanica/".' '.$info['placa'].' '.$info['nsoat'].' '.$info['fsoat'].'.pdf';
        }

        if(isset($_FILES['filecontractual']))
        {
            $namefile= $_FILES['filecontractual']['name'];
            $nameTmpfile=$_FILES['filecontractual']['tmp_name'];
            $ext=substr($namefile, strrpos($namefile,'.'));
            if (in_array($ext,$formato))
            {
                if(move_uploaded_file($nameTmpfile,"documentos/vehiculo/polizaextracontraactual/".' '.$info['placa'].' '.$info['nsoat'].' '.$info['fsoat'].'.pdf'))
                {   
                }
            }else{
                    /*echo "<script type='text/javascript'>
                    alert('ERROR El archivo que esta cargando debe ser PDF');
                    window.location='vehiculoinsert.php';
                    </script>";*/
            }

            $filecontra="documentos/vehiculo/polizaextracontraactual/".' '.$info['placa'].' '.$info['nsoat'].' '.$info['fsoat'].'.pdf';
        }

        if(isset($_FILES['filelicenciatran']))
        {
            $namefile= $_FILES['filelicenciatran']['name'];
            $nameTmpfile=$_FILES['filelicenciatran']['tmp_name'];
            $ext=substr($namefile, strrpos($namefile,'.'));
            if (in_array($ext,$formato))
            {
                if(move_uploaded_file($nameTmpfile,"documentos/vehiculo/licenciatrancito/".' '.$info['placa'].' '.$info['nsoat'].' '.$info['fsoat'].'.pdf'))
                {   
                }
            }else{
                    /*echo "<script type='text/javascript'>
                    alert('ERROR El archivo que esta cargando debe ser PDF');
                    window.location='vehiculoinsert.php';
                    </script>";*/
            }

            $filematric="documentos/vehiculo/licenciatrancito/".' '.$info['placa'].' '.$info['nsoat'].' '.$info['fsoat'].'.pdf';
        }
        $pla=$info['placa'];
        $mar=$info['Marca'];
        $lin=$info['linea'];
        $mod=$info['modelo'];
        $col=$info['color'];
        $ser=$info['Servicio'];
        $cla=$info['clase'];
        $car=$info['carroceria'];
        $carga=$info['carga'];
        $pbruto=$info['pesobruto'];
        $tdir=$info['direccion'];
        $nchasis=$info['nchasis'];
        $VIM=$info['nVIM'];
        $act=$info['actividad'];
        $cil=$info['cilindraje'];
        $nmot=$info['nmotor'];
        $comb=$info['combustible'];
        $nejes=$info['nejes'];
        $ltotal=$info['ltotal'];
        $alto=$info['alto'];
        $ancho=$info['ancho'];
        $dejes=$info['dejes'];
        $nllantas=$info['nllantas'];
        $dimllantas=$info['Dllantas'];
        $nsoat=$info['nsoat'];
        $fsoat=$info['fsoat'];
        $nrotecnico=$info['ntecnico'];
        $ftecnico=$info['ftecnico'];
        $ncontra=$info['ncontractual'];
        $fcontra=$info['fcontractual'];
        $nlicen=$info['nlicenciatran'];
        $fmatri=$info['fmatricula'];
        $queryvehi=new vehiculo;
        $queryveh=$queryvehi->queryvehiculoplaca($pla);

        if($pla=="" or($mar=="") or($lin=="") or($mod=="") or($col=="") or($ser=="") or($cla=="") or($car=="") or($carga=="") or($pbruto=="") or($tdir=="") or($nchasis=="")
        or($VIM=="") or($act=="") or($cil=="") or($nmot=="") or($comb=="") or($nejes=="") or($ltotal=="") or($alto=="") or($ancho=="") or($dejes=="") or($nllantas=="")
        or($dimllantas=="") or($nsoat=="") or($fsoat=="") or($filesoat=="") or($nrotecnico=="") or($ftecnico=="") or($filetecnico=="")or($ncontra=="") or($fcontra=="")
        or($filecontra=="") or($nlicen=="") or($fmatri=="") or($filematric=="") )
        {
            /*echo "<script type='text/javascript'>
            alert('Debe diligenciar todos los campos');
            window.location='vehiculoinsert.php';
            </script>";*/
        }elseif(sizeof($queryveh)>0)
        {
            echo "<script type='text/javascript'>
            alert('El vehiculo ya se encuentra registrado');
            window.location='vehiculoinsert.php';
            </script>";
        }else
        {
            $sql="INSERT INTO vehiculo VALUES(NULL,:pla,:mar,:lin,:model,:col,:cil,:ser,:cla,:car,
            :conb,:ccarg,:pesb,:nejes,:nllan,:dllan,:tdir,:ltotal,:alt,:anch,:entreeje,:nmot,:ncha,:nvim,
            :vsoat,:psoat,:arcsoat,:ntec,:vtec,:arctec,:nlic,:fmatr,:archlic,:uvehi,:pcontra,:vcontra,:arccontra,1)";
            $rest=$this->conex->prepare($sql);
            $rest->execute(array('pla'=>$pla,'mar'=>$mar,'lin'=>$lin,'model'=>$mod,'col'=>$col,'cil'=>$cil,'ser'=>$ser,'cla'=>$cla,'car'=>$car,'conb'=>$comb,'ccarg'=>$carga,
            'pesb'=>$pbruto,'nejes'=>$nejes,'nllan'=>$nllantas,'dllan'=>$dimllantas,'tdir'=>$tdir,'ltotal'=>$ltotal,'alt'=>$alto,'anch'=>$ancho,'entreeje'=>$dejes,'nmot'=>$nmot,
            'ncha'=>$nchasis,'nvim'=>$VIM,'vsoat'=>$fsoat,'psoat'=>$nsoat,'arcsoat'=>$filesoat,'ntec'=>$nrotecnico,'vtec'=>$ftecnico,'arctec'=>$filetecnico,'nlic'=>$nlicen,
            'fmatr'=>$fmatri,'archlic'=>$filematric,'uvehi'=>$act,'pcontra'=>$ncontra,'vcontra'=>$fcontra,'arccontra'=>$filecontra));

            /*echo "<script type='text/javascript'>
            alert('Vehiculo registrado exitosamente');
            window.location='vehiculoinsert.php';
            </script>";*/
        }
    }
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
    public function queryvehiculoplaca($pla)
    {
        if($pla=="")
        {
            echo "<script type='text/javascript'>
            alert('Ingrese el numero de la placa');
            window.location='vehiculoquery.php';
            </script>";
        }else
        {
            $sql="SELECT * FROM `vehiculo`
            INNER JOIN usovheiculo
            ON vehiculo.UsoVheiculo_IdUso=usovheiculo.IdUso
            WHERE vehiculo.Placa=:pla AND vehiculo.Estado=1";
            $rest=$this->conex->prepare($sql);
            $rest->execute(array('pla'=>$pla));
            while($res=$rest->fetch(PDO::FETCH_ASSOC))
            {
                $this->querveh[]=$res;
            }
            return $this->querveh;
        }
    }
    public function deletevehiculo($plac)
    {
        $sql="UPDATE vehiculo SET vehiculo.Estado=0 WHERE vehiculo.Placa=:plac";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array('plac'=>$plac));
        echo "<script type='text/javascript'>
                alert('Registro eliminado exitosamente');
                window.location='../CambulosMantenimiento/vehiculoquery.php';
                </script>";
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
class Rol extends Conexion
{
    public function navrol($rol)
    {
        if($_SESSION['rol']=='ADMIN')
      {
        require('partials/navadmin.php');
      }elseif($_SESSION['rol']=='ADMINISTRATIVO')
      {
        require('partials/navadministrativo.php');
      }elseif($_SESSION['rol']=='CONDUCTOR')
      {
        require('partials/navconductor.php');
      }
    }
}
class actividad extends conexion
{
    private $qactividad=array();
    private $qactivida=array();
    public function queryactividad()
    {
        $sql="SELECT * FROM `usovheiculo`";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array());
        while($res=$rest->fetch(PDO::FETCH_ASSOC))
        {
            $this->qactividad[]=$res;
        }
        return $this->qactividad;
    }
}
?>