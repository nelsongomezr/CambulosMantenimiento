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
    private $queryc=array();
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

        if(isset($_FILES['filelicencia']))
        {
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
                    alert('ERROR El archivo de licencia que esta cargando debe ser PDF');
                    window.location='crudconductor.php';
                    </script>";
            }
        $ruta="documentos/licencia/".' '.$inf[0]['idcond'].' '.$inf[0]['nom'].' '.$inf[0]['ape'].'.pdf';
        }

        if(isset($_FILES['fileautdescuento']))
        {
            $namefile= $_FILES['fileautdescuento']['name'];
            $nameTmpfile=$_FILES['fileautdescuento']['tmp_name'];
            $ext=substr($namefile, strrpos($namefile,'.'));
            if (in_array($ext,$formato))
            {
                if(move_uploaded_file($nameTmpfile,"documentos/conductor/FormatoAutorizacionDescuento/".' '.$inf[0]['idcond'].' '.$inf[0]['nom'].' '.$inf[0]['ape'].'.pdf'))
                {   
                }
            }else{
                    echo "<script type='text/javascript'>
                    alert('ERROR El archivo de formato autorizacion descuento que esta cargando debe ser PDF');
                    window.location='crudconductor.php';
                    </script>";
            }
        $filedescu="documentos/conductor/FormatoAutorizacionDescuento/".' '.$inf[0]['idcond'].' '.$inf[0]['nom'].' '.$inf[0]['ape'].'.pdf';
        }
        
        if(isset($_FILES['filecajamenor']))
        {
            $namefile= $_FILES['filecajamenor']['name'];
            $nameTmpfile=$_FILES['filecajamenor']['tmp_name'];
            $ext=substr($namefile, strrpos($namefile,'.'));
            if (in_array($ext,$formato))
            {
                if(move_uploaded_file($nameTmpfile,"documentos/conductor/FormatoAperturaCajaMenor/".' '.$inf[0]['idcond'].' '.$inf[0]['nom'].' '.$inf[0]['ape'].'.pdf'))
                {   
                }
            }else{
                    echo "<script type='text/javascript'>
                    alert('ERROR El archivo de formato de apertura de caja menor que esta cargando debe ser PDF');
                    window.location='crudconductor.php';
                    </script>";
            }
        $filecaja="documentos/conductor/FormatoAperturaCajaMenor/".' '.$inf[0]['idcond'].' '.$inf[0]['nom'].' '.$inf[0]['ape'].'.pdf';
        }
        
        if(isset($_FILES['fileequipomovil']))
        {
            $namefile= $_FILES['fileequipomovil']['name'];
            $nameTmpfile=$_FILES['fileequipomovil']['tmp_name'];
            $ext=substr($namefile, strrpos($namefile,'.'));
            if (in_array($ext,$formato))
            {
                if(move_uploaded_file($nameTmpfile,"documentos/conductor/FormatoResponsivoEquipoMovil/".' '.$inf[0]['idcond'].' '.$inf[0]['nom'].' '.$inf[0]['ape'].'.pdf'))
                {   
                }
            }else{
                    echo "<script type='text/javascript'>
                    alert('ERROR El archivo de formato responsivo equipo movil que esta cargando debe ser PDF');
                    window.location='crudconductor.php';
                    </script>";
            }
            $filemovil="documentos/conductor/FormatoResponsivoEquipoMovil/".' '.$inf[0]['idcond'].' '.$inf[0]['nom'].' '.$inf[0]['ape'].'.pdf';
        }
        
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
                window.location='crudconductor.php';
                </script>";

            }else
            {                             
                $pass=crypt(10,$id);
                $sql="CALL inserconductor(:id, :nom, :ap, :tel, :cat, :date, :file, :veh, :ed, :tcon, :aexp, :daterunt, :pass,:filedescu, :filecaja, :filemovil)";
                $rest=$this->conex->prepare($sql);
                $rest->execute(array('id'=>$id, 'nom'=>$nom, 'ap'=>$ap, 'tel'=>$tel, 'cat'=>$cat, 'date'=>$date, 'file'=>$file, 'veh'=>$veh, 'ed'=>$ed,
                 'tcon'=>$tcon, 'aexp'=>$aexp, 'daterunt'=>$daterunt, 'pass'=>$pass, 'filedescu'=>$filedescu, 'filecaja'=>$filecaja, 'filemovil'=>$filemovil));
                echo "<script type='text/javascript'>
                alert('Registro realizado exitosamente');
                window.location='crudconductor.php';
                </script>";
            }
    }
    public function updateconductor($updatec)
    {
        $formato[]=('.pdf');

        if (isset($_FILES['cargue']))
        {
            $namefile= $_FILES['cargue']['name'];
            $nameTmpfile=$_FILES['cargue']['tmp_name'];
            $ext=substr($namefile, strrpos($namefile,'.'));
            if (in_array($ext,$formato))
            {
                if(move_uploaded_file($nameTmpfile,"documentos/licencia/".' '.$updatec['id'].' '.$updatec['nom'].' '.$updatec['ap'].'.pdf'))
                {   
                }
            }else
            {
                /*echo "<script type='text/javascript'>
                    alert('ERROR El archivo de licencia de conduccion que esta cargando debe ser PDF');
                    window.location='../CambulosMantenimiento/crudconductor.php';
                    </script>";*/
            }
            $ruta="documentos/licencia/".' '.$updatec['id'].' '.$updatec['nom'].' '.$updatec['ap'].'.pdf';   
        }

        if(isset($_FILES['fileautdescuento']))
        {
            $namefile= $_FILES['fileautdescuento']['name'];
            $nameTmpfile=$_FILES['fileautdescuento']['tmp_name'];
            $ext=substr($namefile, strrpos($namefile,'.'));
            if (in_array($ext,$formato))
            {
                if(move_uploaded_file($nameTmpfile,"documentos/conductor/FormatoAutorizacionDescuento/".' '.$updatec['id'].' '.$updatec['nom'].' '.$updatec['ap'].'.pdf'))
                {   
                }
            }else{
                    /*echo "<script type='text/javascript'>
                    alert('ERROR El archivo de formato autorizacion descuento que esta cargando debe ser PDF');
                    window.location='../CambulosMantenimiento/crudconductor.php';
                    </script>";*/
            }
        $filedescu="documentos/conductor/FormatoAutorizacionDescuento/".' '.$updatec['id'].' '.$updatec['nom'].' '.$updatec['ap'].'.pdf';
        }
        
        if(isset($_FILES['filecajamenor']))
        {
            $namefile= $_FILES['filecajamenor']['name'];
            $nameTmpfile=$_FILES['filecajamenor']['tmp_name'];
            $ext=substr($namefile, strrpos($namefile,'.'));
            if (in_array($ext,$formato))
            {
                if(move_uploaded_file($nameTmpfile,"documentos/conductor/FormatoAperturaCajaMenor/".' '.$updatec['id'].' '.$updatec['nom'].' '.$updatec['ap'].'.pdf'))
                {   
                }
            }else{
                    /*echo "<script type='text/javascript'>
                    alert('ERROR El archivo de formato de apertura de caja menor que esta cargando debe ser PDF');
                    window.location='../CambulosMantenimiento/crudconductor.php';
                    </script>";*/
            }
        $filecaja="documentos/conductor/FormatoAperturaCajaMenor/".' '.$updatec['id'].' '.$updatec['nom'].' '.$updatec['ap'].'.pdf';
        }
        
        if(isset($_FILES['fileequipomovil']))
        {
            $namefile= $_FILES['fileequipomovil']['name'];
            $nameTmpfile=$_FILES['fileequipomovil']['tmp_name'];
            $ext=substr($namefile, strrpos($namefile,'.'));
            if (in_array($ext,$formato))
            {
                if(move_uploaded_file($nameTmpfile,"documentos/conductor/FormatoResponsivoEquipoMovil/".' '.$updatec['id'].' '.$updatec['nom'].' '.$updatec['ap'].'.pdf'))
                {   
                }
            }else{
                    /*echo "<script type='text/javascript'>
                    alert('ERROR El archivo de formato responsivo equipo movil que esta cargando debe ser PDF');
                    window.location='../CambulosMantenimiento/crudconductor.php';
                    </script>";*/
            }
            $filemovil="documentos/conductor/FormatoResponsivoEquipoMovil/".' '.$updatec['id'].' '.$updatec['nom'].' '.$updatec['ap'].'.pdf';
            echo $filemovil;
        }
            
          
        $id=$updatec['id'];
        $nom=$updatec['nom'];
        $ap=$updatec['ap'];
        $tel=$updatec['tel'];
        $cat=$updatec['catlicen'];
        $flicen=$updatec['venlicen'];
        $frunt=$updatec['frunt'];
        $ed=$updatec['edad'];
        $tcon=$updatec['tcon'];
        $aexp=$updatec['expe'];
        $rol=$updatec['rol'];
        $idveh=$updatec['idveh'];

        if($id=="" or($nom=="") or($ap=="") or($tel=="") or($cat=="") or($flicen=="") or($frunt=="") or($ed=="") or($tcon=="") or($aexp=="") or($rol=="") or($idveh=="") )
        {
            echo "<script type='text/javascript'>
            alert('Debe diligenciar todos los campos');
            window.location='conductorquery.php';
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
            conductor.InscripRUNT=:frunt,
            conductor.ArchAutoDescuento=:ArchAutoDescuento,
            conductor.ArchAperturaCaja=:ArchAperturaCaja,
            conductor.ArchEquipoMovil=:ArchEquipoMovil
            WHERE conductor.idConductor=:id";
            $querycond= new  conductor;
            $Quercond=$querycond->queryconductor($id);
            $rest=$this->conex->prepare($sql);
            $rest->execute(array('id'=>$id, 'nom'=>$nom, 'ap'=>$ap, 'tel'=>$tel, 'cat'=>$cat,
            'flicen'=>$flicen, 'files'=>$ruta, 'idveh'=>$idveh, 'rol'=>$rol, 'ed'=>$ed, 'tcon'=>$tcon, 'expe'=>$aexp, 'frunt'=>$frunt,
            'ArchAutoDescuento'=>$filedescu,'ArchAperturaCaja'=>$filecaja,'ArchEquipoMovil'=>$filemovil ));
            $_SESSION['varid']=$Quercond[0]['idConductor'];
            echo "<script type='text/javascript'> 
            alert('Informacion actualizada correctamente.');
            window.location='infoconductor.php ';
            </script>";
        }
        
    }
    public function deleteconductor($id)
    {
        $validar=new prueba;
        $val=$validar->caracteres($id);
        $sql="CALL conductordelete(:id)";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array('id'=>$id));
        echo "<script type='text/javascript'>
                alert('Registro eliminado exitosamente');
                window.location='conductorquery.php';
                </script>";
    }
    public function old($fn)
    {
        $date=date ( 'd-m-Y' );
        $date1= date_create($date);
        $fna= date_create($fn);
        $intervalo=date_diff($fna,$date1);
            foreach ($intervalo as $res)
            {
                $this->queryc[]=$res;
            }
        return $this->queryc;
    }
    
}
class Vehiculo extends Conexion
{
    private $queryvehi=array();
    private $querveh=array();
    private $queve=array();

    public function insertvehiculo($info)
    {
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
                    echo "<script type='text/javascript'>
                    alert('ERROR El archivo que esta cargando debe ser PDF');
                    window.location='vehiculoinsert.php';
                    </script>";
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
                    echo "<script type='text/javascript'>
                    alert('ERROR El archivo que esta cargando debe ser PDF');
                    window.location='vehiculoinsert.php';
                    </script>";
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
                    echo "<script type='text/javascript'>
                    alert('ERROR El archivo que esta cargando debe ser PDF');
                    window.location='vehiculoinsert.php';
                    </script>";
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
                    echo "<script type='text/javascript'>
                    alert('ERROR El archivo que esta cargando debe ser PDF');
                    window.location='vehiculoinsert.php';
                    </script>";
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
            echo "<script type='text/javascript'>
            alert('Debe diligenciar todos los campos');
            window.location='vehiculoinsert.php';
            </script>";
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

            echo "<script type='text/javascript'>
            alert('Vehiculo registrado exitosamente');
            window.location='vehiculoinsert.php';
            </script>";
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
    public function queryvehiculoplacaupdate($pla)
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
    public function deletevehiculo($plac)
    {
        $sql="UPDATE vehiculo SET vehiculo.Estado=0 WHERE vehiculo.Placa=:plac";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array('plac'=>$plac));
        echo "<script type='text/javascript'>
                alert('Registro eliminado exitosamente');
                window.location='vehiculoquery.php';
                </script>";
    }
    public function updatevehiculo ($update)
    {

        $formato[]=('.pdf');

        if(isset($_FILES['filesoat']))
        {
            $namefile= $_FILES['filesoat']['name'];
            $nameTmpfile=$_FILES['filesoat']['tmp_name'];
            $ext=substr($namefile, strrpos($namefile,'.'));
            if (in_array($ext,$formato))
            {
                if(move_uploaded_file($nameTmpfile,"documentos/vehiculo/soat/".' '.$update['placa'].' '.$update['nsoat'].' '.$update['fsoat'].'.pdf'))
                {   
                }
            }else{
                    /*echo "<script type='text/javascript'>
                    alert('ERROR El archivo de SOAT que esta cargando debe ser PDF');
                    window.location='vehiculoupdate.php';
                    </script>";*/
            }
            $filesoat="documentos/vehiculo/soat/".' '.$update['placa'].' '.$update['nsoat'].' '.$update['fsoat'].'.pdf';
        }

        if(isset($_FILES['filetecnico']))
        {
            $namefile= $_FILES['filetecnico']['name'];
            $nameTmpfile=$_FILES['filetecnico']['tmp_name'];
            $ext=substr($namefile, strrpos($namefile,'.'));
            if (in_array($ext,$formato))
            {
                if(move_uploaded_file($nameTmpfile,"documentos/vehiculo/tecnicomecanica/".' '.$update['placa'].' '.$update['nsoat'].' '.$update['fsoat'].'.pdf'))
                {   
                }
            }else{
                    /*echo "<script type='text/javascript'>
                    alert('ERROR El archivo de tecnicomecanica que esta cargando debe ser PDF');
                    window.location='vehiculoupdate.php';
                    </script>";*/
            }

            $filetecnico="documentos/vehiculo/tecnicomecanica/".' '.$update['placa'].' '.$update['nsoat'].' '.$update['fsoat'].'.pdf';
        }

        if(isset($_FILES['filecontractual']))
        {
            $namefile= $_FILES['filecontractual']['name'];
            $nameTmpfile=$_FILES['filecontractual']['tmp_name'];
            $ext=substr($namefile, strrpos($namefile,'.'));
            if (in_array($ext,$formato))
            {
                if(move_uploaded_file($nameTmpfile,"documentos/vehiculo/polizaextracontraactual/".' '.$update['placa'].' '.$update['nsoat'].' '.$update['fsoat'].'.pdf'))
                {   
                }
            }else{
                    /*echo "<script type='text/javascript'>
                    alert('ERROR El archivo de poliza extracontraactual que esta cargando debe ser PDF');
                    window.location='vehiculoupdate.php';
                    </script>";*/
            }

            $filecontra="documentos/vehiculo/polizaextracontraactual/".' '.$update['placa'].' '.$update['nsoat'].' '.$update['fsoat'].'.pdf';
        }

        if(isset($_FILES['filelicenciatran']))
        {
            $namefile= $_FILES['filelicenciatran']['name'];
            $nameTmpfile=$_FILES['filelicenciatran']['tmp_name'];
            $ext=substr($namefile, strrpos($namefile,'.'));
            if (in_array($ext,$formato))
            {
                if(move_uploaded_file($nameTmpfile,"documentos/vehiculo/licenciatrancito/".' '.$update['placa'].' '.$update['nsoat'].' '.$update['fsoat'].'.pdf'))
                {   
                }
            }else{
                    /*echo "<script type='text/javascript'>
                    alert('ERROR El archivo de licencia de transito que esta cargando debe ser PDF');
                    window.location='vehiculoupdate.php';
                    </script>";*/
            }

            $filematric="documentos/vehiculo/licenciatrancito/".' '.$update['placa'].' '.$update['nsoat'].' '.$update['fsoat'].'.pdf';
        }
        $pla=$update['placa'];
        $mar=$update['Marca'];
        $lin=$update['linea'];
        $mod=$update['modelo'];
        $col=$update['color'];
        $ser=$update['Servicio'];
        $cla=$update['clase'];
        $car=$update['carroceria'];
        $carga=$update['carga'];
        $pbruto=$update['pesobruto'];
        $tdir=$update['direccion'];
        $nchasis=$update['nchasis'];
        $VIM=$update['nVIM'];
        $act=$update['actividad'];
        $cil=$update['cilindraje'];
        $nmot=$update['nmotor'];
        $comb=$update['combustible'];
        $nejes=$update['nejes'];
        $ltotal=$update['ltotal'];
        $alto=$update['alto'];
        $ancho=$update['ancho'];
        $dejes=$update['dejes'];
        $nllantas=$update['nllantas'];
        $dimllantas=$update['Dllantas'];
        $nsoat=$update['nsoat'];
        $fsoat=$update['fsoat'];
        $nrotecnico=$update['ntecnico'];
        $ftecnico=$update['ftecnico'];
        $ncontra=$update['ncontractual'];
        $fcontra=$update['fcontractual'];
        $nlicen=$update['nlicenciatran'];
        $fmatri=$update['fmatricula'];

        if($pla=="" or($mar=="") or($lin=="") or($mod=="") or($col=="") or($ser=="") or($cla=="") or($car=="") or($carga=="") or($pbruto=="") or($tdir=="") or($nchasis=="")
        or($VIM=="") or($act=="") or($cil=="") or($nmot=="") or($comb=="") or($nejes=="") or($ltotal=="") or($alto=="") or($ancho=="") or($dejes=="") or($nllantas=="")
        or($dimllantas=="") or($nsoat=="") or($fsoat=="") or($filesoat=="") or($nrotecnico=="") or($ftecnico=="") or($filetecnico=="")or($ncontra=="") or($fcontra=="")
        or($filecontra=="") or($nlicen=="") or($fmatri=="") or($filematric=="") )
        {
            echo "<script type='text/javascript'>
            alert('Debe diligenciar todos los campos');
            window.location='vehiculoquery.php';
            </script>";
        }else
        {
            $sql="UPDATE vehiculo SET vehiculo.Placa=:pla,
            vehiculo.Marca=:mar,vehiculo.Linea=:lin,vehiculo.modelo=:model,vehiculo.Color=:col,vehiculo.Cilindraje=:cil,
            vehiculo.Servicio=:ser,vehiculo.ClaseVehiculo=:cla,vehiculo.TipoCarroceria=:car,vehiculo.Combustible=:conb,
            vehiculo.CapacidadCarga=:ccarg,vehiculo.PesoBruto=:pesb,vehiculo.NoEjes=:nejes,vehiculo.NoLlantas=:nllan,
            vehiculo.DimensionLLanta=:dllan,vehiculo.TipoDireccion=:tdir,vehiculo.LongitudTotal=:ltotal,
            vehiculo.Alto=:alt,vehiculo.Ancho=:anch,vehiculo.DistaEntreEjes=:entreeje,vehiculo.NumeroMotor=:nmot,
            vehiculo.NoChasis=:ncha,vehiculo.NoVim=:nvim,vehiculo.VenceSoat=:vsoat,vehiculo.PolizaSoat=:psoat,
            vehiculo.ArchSoat=:arcsoat,vehiculo.NoTecnicomecanica=:ntec,vehiculo.VenceTecnicomecanica=:vtec,
            vehiculo.ArchiTecnicomecanica=:arctec,vehiculo.NoLicenciatrancito=:nlic,vehiculo.FechaMatricula=:fmatr,
            vehiculo.ArchiLicenciaTrancito=:archlic,vehiculo.UsoVheiculo_IdUso=:uvehi,vehiculo.polizacontraactual=:pcontra,
            vehiculo.VencePolizaContraactual=:vcontra,vehiculo.archPolizaContraActual=:arccontra,vehiculo.Estado=1
           WHERE vehiculo.Placa=:pla";

            $rest=$this->conex->prepare($sql);
            $rest->execute(array('pla'=>$pla,'mar'=>$mar,'lin'=>$lin,'model'=>$mod,'col'=>$col,'cil'=>$cil,'ser'=>$ser,'cla'=>$cla,'car'=>$car,'conb'=>$comb,'ccarg'=>$carga,
            'pesb'=>$pbruto,'nejes'=>$nejes,'nllan'=>$nllantas,'dllan'=>$dimllantas,'tdir'=>$tdir,'ltotal'=>$ltotal,'alt'=>$alto,'anch'=>$ancho,'entreeje'=>$dejes,'nmot'=>$nmot,
            'ncha'=>$nchasis,'nvim'=>$VIM,'vsoat'=>$fsoat,'psoat'=>$nsoat,'arcsoat'=>$filesoat,'ntec'=>$nrotecnico,'vtec'=>$ftecnico,'arctec'=>$filetecnico,'nlic'=>$nlicen,
            'fmatr'=>$fmatri,'archlic'=>$filematric,'uvehi'=>$act,'pcontra'=>$ncontra,'vcontra'=>$fcontra,'arccontra'=>$filecontra));
            $_SESSION['placa']=$update['placa'];
            echo "<script type='text/javascript'>
            alert('Informacion del vehiculo a sido actualizada exitosamente');
            window.location='vehiculoupdate.php';
            </script>";
        
        }
    }
    public function queryvehiculoid($id)
    {

        $sql="SELECT * FROM `vehiculo` WHERE vehiculo.idVehiculo=:id AND vehiculo.Estado=1";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array('id'=>$id));
        while($res=$rest->fetch(PDO::FETCH_ASSOC))
        {
            $this->queve[]=$res;
        }
        return $this->queve;
    }
}
class user extends Conexion
{
    private $use=array();
    private $us=array();
    private $u=array();
    
    public function queryuser($id)
     // realiza consulta de usuarios por id
    {
        if($id=="")
        {
            echo "<script type='text/javascript'>
            alert('Debe diligenciar el Numero de Cedula');
            window.location='userquery.php';
            </script>";

        }else{

            $sql="SELECT * FROM `usuario` INNER JOIN rol ON USUARIO.Rol_idRol=rol.idRol WHERE usuario.idUsuario=:id AND usuario.Estado=1";
            $rest=$this->conex->prepare($sql);
            $rest->execute(array('id'=>$id));
            while($res=$rest->fetch(PDO::FETCH_ASSOC))
        {
            $this->use[]=$res;
        }
        return $this->use;
        
        }
        
    }
    public function quereyusername($nom)
    // realiza consulta de usuarios por nombre o apellido
    {
        $validar=new prueba;
        $val=$validar->caracteres($nom);
        if($nom=="")
        {
            echo "<script type='text/javascript'>
                    alert('Ingrese el nombre o apellido a consultar');
                    window.location='userquery.php';
                    </script>";
        }else
        {
            $nomb= $nom.'%';
            $sql="SELECT * FROM `usuario` WHERE usuario.Estado=1 AND usuario.Nombre LIKE :nom OR usuario.Apellido LIKE :nom ORDER by usuario.Nombre ASC";
            $rest=$this->conex->prepare($sql);
            $rest->execute(array('nom'=>$nomb));
            while($res=$rest->fetch(PDO::FETCH_ASSOC))
            {
                $this->u[]=$res;
            }
            return $this->u;
        }
    }
    public function queryalluser()
     // realiza consulta de todos los usuarios registrados
    {
        $sql="SELECT * FROM `usuario` where usuario.estado=1";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array());
        while($res=$rest->fetch(PDO::FETCH_ASSOC))
        {
            $this->us[]=$res;
        }
        return $this->us;
    }
    public function insertuser($inf)
    //realiza el registro de usuarios
    {
        $validar=new prueba;
        $val=$validar->caracteres($inf);
        if($inf[0]['idcond']=="" or($inf[0]['nom'])=="" or($inf[0]['ape'])=="" or($inf[0]['email'])=="" or($inf[0]['tel'])=="" or($inf[0]['rol'])=="")
        {
            echo "<script type='text/javascript'>
                    alert('debe diligenciar todos los campos');
                    </script>";
            
        }else
        {
            $inf[0]['idcond'];
            $pass=crypt(10,$inf[0]['idcond']);
            $sql="INSERT INTO usuario VALUES(:id,:nom,:ap,:email,:tel,:rol,:pass,1)";
            $rest=$this->conex->prepare($sql);
            $rest->execute(array('id'=>$inf[0]['idcond'],'nom'=>$inf[0]['nom'],'ap'=>$inf[0]['ape'],'email'=>$inf[0]['email'],
            'tel'=>$inf[0]['tel'],'rol'=>$inf[0]['rol'], 'pass'=>$pass));
            echo "<script type='text/javascript'>
            alert('usuario registrado exitosamente  ');
            window.location='userquery.php';
            </script>";
        }
        
    }
    public function updateuser($inf)
    //actualiza la informacion del usuario
    {   
        $validar=new prueba;
        $val=$validar->caracteres($inf);
        $id=$inf['idcond'];
        $nom=$inf['nom'];
        $ape=$inf['ape'];
        $tel=$inf['tel'];
        $email=$inf['email'];
        $rol=$inf['rol'];
        if($id=="" or($nom)=="" or($ape)=="" or($tel)=="" or($email)=="" or($rol==""))
        {
            
           /*echo "<script type='text/javascript'>
                    alert('debe diligenciar todos los campos');
                    window.location='userquery.php';
                    </script>";*/

        }else
        {
            $sql="UPDATE usuario SET usuario.idUsuario=:id, usuario.Nombre=:nom, usuario.Apellido=:ap,usuario.Email=:email, usuario.Telefono=:tel, usuario.Rol_idRol=:rol WHERE usuario.idUsuario=:id";
            $rest=$this->conex->prepare($sql);
            $rest->execute(array('id'=>$id, 'nom'=>$nom, 'ap'=>$ape, 'email'=>$email, 'tel'=>$tel, 'rol'=>$rol));
            
            $_SESSION['varid']=$inf['idcond'];
            echo "<script type='text/javascript'>
            alert('Informacion actualizada correctamente');
            window.location='userinfo.php';
            </script>";
        }
        
    }
    public function deleteuser($id)
    {
        $validar=new prueba;
        $val=$validar->caracteres($id);
        $sql="UPDATE usuario SET usuario.Estado=0 WHERE usuario.idUsuario=:id";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array('id'=>$id));
        echo "<script type='text/javascript'>
        alert('El usuario se elimino correctamente');
        window.location='userquery.php';
        </script>";
    }
}
class Rol extends Conexion
{
    private $rol=array();
    private $ro=array();
    public function queryAllRol()
    {
        $sql="SELECT * from rol";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array());
        foreach($rest as $res)
        {
            $this->rol[]=$res;
        }
        return $this->rol;
    }
    public function queryUserId($id)
    {   
        $validar=new prueba;
        $val=$validar->caracteres($id);
        $sql="SELECT * FROM usuario WHERE usuario.idUsuario=:id";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array('id'=>$id));
        foreach($rest as $res)
        {
            $this->ro[]=$res;
        }
        return $this->ro;
    }

    public function navrol($rol)
    // muestra el menu segun el rol del uauario que inicie sesion
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
class comparendo extends Conexion
{
    private $compar=array();
    private $compa=array();
    private $comp=array();
    private $com=array();
    public function insertcomparendo($comp)
    // registra la informacion del comparendo en la base
    {
        $nrpcomp=$comp['NroComp'];
        $tip=$comp['Tipo'];
        $fech=$comp['fecha'];
        $sec=$comp['secretaria'];
        $infrac=$comp['infraccion'];
        $est=$comp['estado'];
        $val=$comp['val'];
        $valapa=$comp['valapa'];
        $id=$comp['id'];

        if($nrpcomp=="" or($tip)=="" or($fech)=="" or($sec)=="" or($infrac)=="" or($est)=="" or($val)=="" or($valapa)=="" or($id)=="")
        {
            echo "<script type='text/javascript'>
            alert('Debe diligenciar todos los campos');
            window.location='reportecomparendos.php';
            </script>";
        }else
        {
            $conductor= new conductor;
            $quericonductor=$conductor->queryconductor($comp['id']);
            $querycom=new comparendo;
            $queryco=$querycom->querynrocomparendo($nrpcomp);
            if(sizeof($queryco)<=0)
            {
                if(sizeof($quericonductor)>0)
                {
                    $sql="INSERT INTO comparendos
                    values(NULL,:nrpcomp,:tip,:fech,:sec,:infrac,:est,:val,:valapa,1,:id,NULL)";
                    $rest=$this->conex->prepare($sql);
                    $rest->execute(array('nrpcomp'=>$nrpcomp,'tip'=>$tip,'fech'=>$fech,'sec'=>$sec,'infrac'=>$infrac,'est'=>$est,'val'=>$val,'valapa'=>$valapa,'id'=>$id));
                    echo "<script> alert('Comparendo registrado exitosamente'); </script>";

                }else
                {
                    $sql="INSERT INTO comparendos
                    values(NULL,:nrpcomp,:tip,:fech,:sec,:infrac,:est,:val,:valapa,1,NULL,:id)";
                    $rest=$this->conex->prepare($sql);
                    $rest->execute(array('nrpcomp'=>$nrpcomp,'tip'=>$tip,'fech'=>$fech,'sec'=>$sec,'infrac'=>$infrac,'est'=>$est,'val'=>$val,'valapa'=>$valapa,'id'=>$id));
                    echo "<script> alert('Comparendo registrado exitosamente'); </script>";
                }
            }else
            {
                echo "<script> alert('Comparendo ya se encuentra registrado'); </script>";
            }
        }
    }
    public function querynrocomparendo($nro)
    //consulta comparendos por numero de comparendo con datos del conductor
    {
        $sql="SELECT * FROM `comparendos` 
        INNER JOIN Conductor
        ON comparendos.Conductor_IdConductor=conductor.idConductor
        WHERE comparendos.NroComp=:nrocomp";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array('nrocomp'=>$nro));
        while($res=$rest->fetch(PDO::FETCH_ASSOC))
        {
            $this->com[]=$res;
        }
        return $this->com;
    }

    public function querynrocomparendovehi($nro)
    //consulta comparendos por numero de comparendo con datos del conductor
    {
        $sql="SELECT * FROM comparendos
        INNER JOIN vehiculo
        ON comparendos.Vehiculo_IdVehiculoo=vehiculo.idVehiculo
        WHERE comparendos.NroComp=:nrocomp";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array('nrocomp'=>$nro));
        while($res=$rest->fetch(PDO::FETCH_ASSOC))
        {
            $this->com[]=$res;
        }
        return $this->com;
    }
    public function querycomparvehicle($id)
     // consulta comparendos por placa de vehiculo
    {

        $sql="SELECT * FROM comparendos 
        INNER JOIN Vehiculo
        ON comparendos.Vehiculo_IdVehiculoo=vehiculo.idVehiculo
        WHERE comparendos.Vehiculo_IdVehiculoo=:id AND comparendos.Eliminar=1";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array('id'=>$id));
        while($res=$rest->fetch(PDO::FETCH_ASSOC))
        {
            $this->compar[]=$res;
        }
        return $this->compar;
    }
    public function querycomparconddriver($id)
    // consulta comparendos por id de conductor
    {
        $sql="SELECT * FROM comparendos 
        INNER JOIN conductor
        ON comparendos.Conductor_IdConductor=conductor.idConductor
        WHERE comparendos.Conductor_IdConductor=:id AND comparendos.Eliminar=1";
        $rest=$this->conex->prepare($sql);
        $rest->execute(array('id'=>$id));
        while($res=$rest->fetch(PDO::FETCH_ASSOC))
        {
            $this->compa[]=$res;
        }
        return $this->compa;
    }
    public function makefindcomp($id)
    /* incluye en una sola funcion las funciones querycomparconddriver y  querycomparconddriver para automatizar 
    el uso de cada una, dependiendo del id que se ingrese para la consulta (conductor o vehiculo)*/
    {  
        $finds= new comparendo;
        $fin=$finds->querycomparvehicle($id);

        if(sizeof($fin)==0)
        {
            $fin=$finds->querycomparconddriver($id);
            
        }
        return $fin; 
    }
    public function simit($ids)
    // envia el id del condutor o la placa del vehiculo para realizar la consulta en el SIMIT
    {
        $vehiculo=new vehiculo;
        $placa=$vehiculo->queryvehiculoid($ids);
        if(sizeof($placa)>0)
        {
            $simit=$placa[0]['Placa'];
        }else
        {
            $simit=$ids;    
        }
        return $simit;
    }
    public function updatecomparendo($compup)
    //realiza update de los datos del comparendo en la base
    {
        $NroComp=$compup['NroComp'];
        $TComp=$compup['Tipo'];
        $Fcomp=$compup['fecha'];
        $sec=$compup['secretaria'];
        $infrac=$compup['infraccion'];
        $est=$compup['estado'];
        $val=$compup['val'];
        $valapa=$compup['valapa'];
        $id=$compup['id'];

        $valid=new comparendo;
        $valida=$valid->querycomparconddriver($compup['id']);
        if($NroComp=="" or($TComp)=="" or($Fcomp)=="" or($sec)=="" or($infrac)=="" or($est)=="" or($val)=="" or($valapa)=="" or($id)=="")
        {
            echo "<script type='text/javascript'>
            alert('Debe diligenciar todos los campos');
            window.location='comparendoupdate.php';
            </script>";
        }else
        {   
            if(sizeof($valida)>0)
            {
                $sql="UPDATE comparendos SET 
                comparendos.NroComp=:ncomp,
                comparendos.TipoComparendo=:tcomp,
                comparendos.Fecha=:fcomp,
                comparendos.Secretaria=:scomp,
                comparendos.Infraccion=:infcomp,
                comparendos.Estado=:ecomp,
                comparendos.Valor=:vcomp,
                comparendos.ValorApagar=:vpcomp,
                comparendos.Eliminar=1,
                comparendos.Conductor_IdConductor=:id
                WHERE comparendos.NroComp=:ncomp";
            }else
            {
                $sql="UPDATE comparendos SET 
                comparendos.NroComp=:ncomp,
                comparendos.TipoComparendo=:tcomp,
                comparendos.Fecha=:fcomp,
                comparendos.Secretaria=:scomp,
                comparendos.Infraccion=:infcomp,
                comparendos.Estado=:ecomp,
                comparendos.Valor=:vcomp,
                comparendos.ValorApagar=:vpcomp,
                comparendos.Eliminar=1,
                comparendos.Vehiculo_IdVehiculoo=:id
                WHERE comparendos.NroComp=:ncomp";
            }

            $rest=$this->conex->prepare($sql);
            $rest->execute(array('ncomp'=>$NroComp, 'tcomp'=>$TComp, 'fcomp'=>$Fcomp, 'scomp'=>$sec, 'infcomp'=>$infrac, 'ecomp'=>$est, 'vcomp'=>$val, 'vpcomp'=>$valapa, 'id'=>$id));
            $_SESSION['comparendo']=$NroComp;
            /*echo "<script type='text/javascript'>
            alert('Comparendo actualizado correctamente');
            window.location='comparendoupdate.php';
            </script>";*/   
        }    
    }
    public function deletecomparendo($del)
    // desabilita el registro del comparendo para que no sea visible en las consultas
    {
            $sql="UPDATE comparendos SET comparendos.Eliminar=0 WHERE comparendos.NroComp=:del";
            $rest=$this->conex->prepare($sql);
            $rest->execute(array('del'=>$del));

            $delete= new comparendo;
            $compar=$delete->querynrocomparendo($del);
            if(sizeof($compar)>0)
            {
                echo $_SESSION['varid']=$compar[0]['Conductor_IdConductor'];   
                
                echo "<script type='text/javascript'>
                alert('Comparendo eliminado exitosamente');
                window.location='reportecomparendos.php';
                </script>";
            }else
            {
            echo $_SESSION['varid'];
            $comprvehi=$delete->querynrocomparendovehi($_GET['id']);
            $_SESSION['varid']=$comprvehi[0]['Vehiculo_IdVehiculoo'];

            echo "<script type='text/javascript'>
            alert('Comparendo eliminado exitosamente');
            window.location='reportecomparendos.php';
            </script>";
            }
            
    }
}
class alerts extends Conexion
{
    private $alerts=array();
    private $alert=array();
    private $aler=array();
    
    public function querydiasvence()
    //consulta los dias que restan para el vencimiento de SOAT, tecnocomecanica y poliza contraactual
    {
        $fecha=date('Y-m-d');
        $sql="SELECT vehiculo.VenceSoat, vehiculo.VencePolizaContraactual, vehiculo.VenceTecnicomecanica, vehiculo.Placa, 
        DATEDIFF('$fecha',vehiculo.VenceSoat ) as dias_SOAT, 
        DATEDIFF('$fecha',vehiculo.VencePolizaContraactual ) as dias_extracontractual,
        DATEDIFF('$fecha',vehiculo.VenceTecnicomecanica ) as dias_tenicomecanica
        FROM vehiculo";
        
        $rest=$this->conex->prepare($sql);
        $rest->execute(array());
        while($res=$rest->fetch(PDO::FETCH_ASSOC))
        {
            $this->alerts[]=$res;
        }
        return $this->alerts;
    }
    public function alertasVencimientosVehiculo()
    //envia correos y alertas a las usuarios administrativos del vecimiento de SOAT, Tecnicomecanica y poliza extracontractual
    { 
        $alerta=new alerts;
        $use= new user;
        $aler=$alerta->querydiasvence(date('Y-m-d'));
        $users=$use->queryalluser();
               foreach($aler as $alert)
        {
            if($alert['dias_SOAT']>=0)
            {
                echo "<script type='text/javascript'>
                alert('Atencion!!! el SOAT del vehiculo $alert[Placa] a vencido, por favor renovar y actualizar los datos en el sistema');
                </script>";
            }
            if($alert['dias_extracontractual']>=0)
            {
                echo "<script type='text/javascript'>
                alert('Atencion!!! la poliza extracontractual del vehiculo $alert[Placa] a vencido, por favor renovar y actualizar los datos en el sistema');
                </script>";
            }
            if($alert['dias_tenicomecanica']>=0)
            {
                echo "<script type='text/javascript'>
                alert('Atencion!!! la Revision tecnicomecanica del vehiculo $alert[Placa] a vencido, por favor renovar y actualizar los datos en el sistema');
                </script>";
            }
        }

    }
    public function sendmailnotification()
    //envia correos y alertas a las usuarios administrativos del vecimiento de SOAT, Tecnicomecanica y poliza extracontractual
    {
        
        $alerta=new alerts;
        $use= new user;
        $aler=$alerta->querydiasvence(date('Y-m-d'));
        $users=$use->queryalluser();
               foreach($aler as $alert)
        {
            if($alert['dias_SOAT']>=0)
            {

                mail('nelsonaldevaran@gmail.com','Atencion!!!!! Vencio el SOAT del vehiculo '.$alert['Placa'],' El Soat del vehiculo'.$alert['Placa'].' vencio el '.$alert['VenceSoat'].
                'por favor renovarlo y actualizar la informacion en el sistema');
            }
            if($alert['dias_extracontractual']>=0)
            {

                mail('nelsonaldevaran@gmail.com','Atencion!!!!! Vencio La poliza contractual del vehiculo '.$alert['Placa'],' La poliza del vehiculo'.$alert['Placa'].' vencio el '.$alert['VencePolizaContraactual'].
                'por favor renovarlo y actualizar la informacion en el sistema');
            }
            if($alert['dias_tenicomecanica']>=0)
            {

                 mail('nelsonaldevaran@gmail.com','Atencion!!!!! Vencio La revision tecnicomecanica del vehiculo '.$alert['Placa'],' La poliza del vehiculo'.$alert['Placa'].' vencio el '.$alert['VenceTecnicomecanica'].
                'por favor renovarlo y actualizar la informacion en el sistema');
            }
        }

    }
}
class valida
{
    public function caracteres($str)
    // valida que los datos ingresados no contengan caracteres especiales
    {

        $res = preg_replace('/[*\;\<\>\*\#\=\'\""]+/', '', $str);
        echo "<script type='text/javascript'>
        alert('Solo Alfanumerico');
        </script>";
        return $res;
    }   
}
?>