<?php 
session_start();
if($_SESSION==null || $_SESSION=="")
{
    echo "<script type='text/javascript'>
    alert('usted no tiene acceso permitido');
    window.location='index.php';
    </script>";
    die();
}
if (empty($_GET))
{
 $pla=$_SESSION['placa'];
}else
{
    $pla=$_GET['id'];
}

require('class/class.php');
$nav= new rol;
$act=new actividad;
$vehi=new vehiculo;
$marca=$vehi->querymarca();
$color=$vehi->querycolor();
$servicio=$vehi->queryservicio();
$clase=$vehi->queryclase();
$carroceria=$vehi->querycarroceria();
$direccion=$vehi->querydireccion();
$conbustible=$vehi->querycombustible();
$llanta=$vehi->queryllanta();
$acti=$act->queryactividad();
$veh=$vehi->queryvehiculoplacaupdate($pla);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Actualizacion informacion vehiculos</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>
  <body class="">
    <?php $na=$nav->navrol($_SESSION['rol']) ?>
    <br>
    <center><h1>ACTUALIZACION INFORMACION VEHICULOS</h1></center>
    <div class="accordion accordion-flush container" id="accordionFlushExample">
    <form method="POST" enctype="multipart/form-data">
  <div class="accordion-item bg-secondary bg-opacity-10">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        <b>Informacion general del vehiculo</b>
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
            <label class="form-label">
                <b>Placa</b><br>
                <input type="text" name="placa" class="form-control" value="<?php echo $veh[0]['Placa'];?>">
            </label>
            <label class="form-label">
                <b>Clase de vehiculo</b><br>
                <select name="clase" class="form-select">
                        <option value="<?php echo $veh[0]['Clase_IdClase'];?>"><?php echo $veh[0]['ClaseVehiculo'];?></option>
                        <?php foreach($clase as $clas){?>
                            <option value="<?php echo $clas['IdClase'] ?>"> <?php echo $clas['ClaseVehiculo'] ?></option>
                        <?php }?>
                </select>
            </label>
            <label class="form-label">
                <b>Tipo carroceria</b><br>
                <select name="carroceria" class="form-select">
                    <option value="<?php echo $veh[0]['idTipoCarroceria'];?>"><?php echo $veh[0]['TipoCarroceria'];?> Tipo carroceria actual</option>
                    <?php foreach($carroceria as $carroce){?>
                        <option <?php echo $carroce['idTipoCarroceria']?>><?php echo $carroce['TipoCarroceria']?></option>
                    <?php }?>
                </select>
            </label>
      </div>

        <div class="accordion-body">

            <label class="form-label">
                <b>Servicio</b><br>
                <select name="Servicio" class="form-select">
                        <option value="<?php echo $veh[0]['Servicio_IdServicio'];?>"><?php echo $veh[0]['Servicio'];?> Servicio actual</option>
                    <?php foreach($servicio as $ser){?>
                        <option value="<?php echo $ser['Servicio_IdServicio']?>"><?php echo $ser['Servicio']?></option>
                        <?php }?>
                </select>
            </label>

            <label class="form-label">
                <b>Actividad del vehiculo</b><br>
                <select name="actividad" class="form-select" >
                    <option value="<?php echo $veh[0]['IdUso'];?>"><?php echo $veh[0]['UsoVheiculocol'].' Actividad actual';?></option>
                    <?php
                    for($i=0;$i<sizeof($acti);$i++)
                    {
                    ?>
                    <option value="<?php echo $acti[$i]['IdUso'] ?>"><?php echo $acti[$i]['UsoVheiculocol'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </label>

            <label class="form-label">
                <b>Capacidad carga (Kg)</b><br>
                <input type="number" name="carga" class="form-control" value="<?php echo $veh[0]['CapacidadCarga'];?>">
            </label>
            <label class="form-label">
                <b>Peso bruto vehiculo (Kg)</b><br>
                <input type="number" name="pesobruto" class="form-control" value="<?php echo $veh[0]['PesoBruto'];?>">
            </label>

        </div>

        <div class="accordion-body">

            <label class="form-label">
                <b>Tipo direccion</b><br>
                <select name="direccion" class="form-select">
                    <option value="<?php echo $veh[0]['IdDireccion'];?>"><?php echo $veh[0]['tipiDireccion'];?> Direccion actual</option>
                    <?php foreach($direccion as $direc){?>
                    <option value="<?php echo $direc['IdDireccion'];?>"><?php echo $direc['tipiDireccion'];?></option>
                    <?php }?>
                </select>
            </label>
            <label class="form-label">
                <b>Numero de chasis</b><br>
                <input type="text" name="nchasis" class="form-control" value="<?php echo $veh[0]['NoChasis'];?>">
            </label>
            <label class="form-label">
                <b>Numero de VIM</b><br>
                <input type="text" name="nVIM" class="form-control" value="<?php echo $veh[0]['NoVim'];?>">
            </label>
            <label class="form-label">
                <b>Color</b><br>
                <select name="color" class="form-select">
                        <option value="<?php echo $veh[0]['Color_IdColor'];?>"><?php echo $veh[0]['Color'];?> Color Actual</option>
                    <?php foreach($color as $col){?>
                        <option value="<?php echo $col['Color_IdColor'] ?>"><?php echo $col['Color'] ?></option>
                    <?php }?>
                </select>
            </label>
        </div>
        <div class="accordion-body">
        <label class="form-label">
                <b>Marca</b><br>
                <select name="Marca" class="form-select" id="selectmarca">
                    <option value="<?php echo $veh[0]['Marca_IdMarca']?>"><?php echo $veh[0]['NombreMarca']?> Marca Actual</option>
                    <?php foreach($marca as $mar){ ?>
                        <option value="<?php echo $mar['idMarca']?>"><?php echo $mar['NombreMarca']?></option>
                    <?php }?>
                </select>
            </label>

            <label class='form-label'>
            <b>Linea</b><br>
            <select name="linea"class="form-select" id="datoslinea">
                <option>Seleccione la linea</option>
            </select>
            </label>
            
            <label class="form-label">
                <b>Modelo</b><br>
                <?php $cont=date('Y')?>
                <select name="modelo" class="form-select">
                <?php while ($cont >= 1970) { ?>
                    <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                    <?php $cont = ($cont-1); } ?>
                </select>
            </label>

        </div>
    </div>
  </div>

    <div class="accordion-item bg-secondary bg-opacity-10">
        <h2 class="accordion-header" id="flush-headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
            <b>Motor</b>
          </button>
        </h2>
        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">

            <label class="form-label">
                <b>Cilindraje (CM³)</b><br>
                <input type="number" name="cilindraje" class="form-control" value="<?php echo $veh[0]['Cilindraje'];?>">
            </label>
            <label class="form-label">
                <b>Numero de motor</b><br>
                <input type="text" name="nmotor" class="form-control" value="<?php echo $veh[0]['NumeroMotor'];?>">
            </label>
            <label class="form-label">
                <b>Tipo combustible</b><br>
                <select name="combustible" class="form-select">
                    <option value="<?php echo $veh[0]['Combustible_Idcombustible'];?>"><?php echo $veh[0]['Combustuble'];?> Tipo Combustible actual</option>
                    <?php foreach($conbustible as $comb){?>
                        <option value="<?php echo $comb['Combustible_Idcombustible']?>"><?php echo $comb['Combustuble']?></option>
                    <?php }?>
                </select>
            </label>
        </div>
        </div>
    </div>


    <div class="accordion-item bg-secondary bg-opacity-10">
        <h2 class="accordion-header" id="flush-headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
            <b>Dimenciones</b>
          </button>
        </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
                  
            <label class="form-label">
                <b>Nunero de ejes</b><br>
                <input type="number" name="nejes" class="form-control" value="<?php echo $veh[0]['NoEjes'];?>">
            </label>
            <label class="form-label">
                <b>Longitud total (mm)</b><br>
                <input type="number" name="ltotal" class="form-control" value="<?php echo $veh[0]['LongitudTotal'];?>">
            </label>
            <label class="form-label">
                <b>Alto (mm)</b><br>
                <input type="number" name="alto" class="form-control" value="<?php echo $veh[0]['Alto'];?>">
            </label>
            <label class="form-label">
                <b>Ancho (mm)</b><br>
                <input type="number" name="ancho" class="form-control" value="<?php echo $veh[0]['Ancho'];?>">
            </label>
            <label class="form-label">
                <b>Distancia entre ejes (mm)</b><br>
                <input type="number" name="dejes" class="form-control" value="<?php echo $veh[0]['DistaEntreEjes'];?>">
            </label>

        </div>
    </div>
    </div>

    <div class="accordion-item bg-secondary bg-opacity-10">
        <h2 class="accordion-header" id="flush-headingFour">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
            <b>Llantas</b>
        </button>
        </h2>
        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <label class="form-label">
                    <b>Numero de llantas</b><br>
                    <input type="number" name="nllantas" class="form-control" value="<?php echo $veh[0]['NoLlantas'];?>">
                </label>
                <label class="form-label">
                    <b>Dimensiones llantas</b><br>
                    <select name="Dllantas" class="form-select">
                        <option value="<?php echo $veh[0]['Llanta_idLlanta'];?>"><?php echo $veh[0]['Dimenciones'];?> Dimencion llanta actual</option>
                        <?php foreach($llanta as $llan){?>
                            <option value="<?php echo $llan['Llanta_idLlanta']?>"><?php echo $llan['Dimenciones']?></option>
                        <?php }?>
                    </select>
                </label>
            </div>
        </div>
    </div>
  
    <div class="accordion-item bg-secondary bg-opacity-10">
        <h2 class="accordion-header" id="flush-headingFive">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
            <b>SOAT</b>
        </button>
        </h2>
        <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <label class="form-label">
                    <b>Numero poliza </b><br>
                    <input type="text" name="nsoat" class="form-control" value="<?php echo $veh[0]['PolizaSoat'];?>">
                </label>
                <label class="form-label">
                    <b>Fecha vencimiento</b><br>
                    <input type="date" name="fsoat" class="form-control" value="<?php echo $veh[0]['VenceSoat'];?>">
                </label>
                <label class="form-label">
                    <b>Cargar PDF SOAT</b><br>
                    <input name="filesoat" class="form-control" type="file" id="formFile" value="<?php echo $veh[0]['ArchSoat'];?>">
                </label>
            </div>
        </div>
    </div>

  <div class="accordion-item bg-secondary bg-opacity-10">
    <h2 class="accordion-header" id="flush-headingSix">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
        <b>Tecnicomecanica</b>
      </button>
    </h2>
    <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
            <label class="form-label">
                <b>Numero revision </b><br>
                <input type="text" name="ntecnico" class="form-control" value="<?php echo $veh[0]['NoTecnicomecanica'];?>">
            </label>
            <label class="form-label">
                <b>Fecha vencimiento</b><br>
                <input type="date" name="ftecnico" class="form-control" value="<?php echo $veh[0]['VenceTecnicomecanica'];?>">
            </label>
            <label class="form-label">
                <b>Cargar PDF Tecnicomecanica</b><br>
                <input name="filetecnico" class="form-control" type="file" id="formFile" value="ArchiTecnicomecanica">
            </label>
        </div>
    </div>
  </div>

    <div class="accordion-item bg-secondary bg-opacity-10">
        <h2 class="accordion-header" id="flush-headingSeven">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
            <b>Poliza extracontractual</b>
        </button>
        </h2>
        <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <label class="form-label">
                    <b>Numero poliza </b><br>
                    <input type="text" name="ncontractual" class="form-control" value="<?php echo $veh[0]['polizacontraactual'];?>">
                </label>
                <label class="form-label">
                    <b>Fecha vencimiento</b><br>
                    <input type="date" name="fcontractual" class="form-control" value="<?php echo $veh[0]['VencePolizaContraactual'];?>">
                </label>
                <label class="form-label">
                    <b>Cargar PDF Poliza extracontractual</b><br>
                    <input name="filecontractual" class="form-control" type="file" id="formFile" value="<?php echo $veh[0]['archPolizaContraActual'];?>">
                </label>   
            </div>
        </div>
    </div>

    <div class="accordion-item bg-secondary bg-opacity-10">
        <h2 class="accordion-header" id="flush-headingEigth">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEigth" aria-expanded="false" aria-controls="flush-collapseEigth">
            <b>Licencia de trancito</b>
        </button>
        </h2>
        <div id="flush-collapseEigth" class="accordion-collapse collapse" aria-labelledby="flush-headingEigth" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <label class="form-label">
                    <b>Numero licencia trancito </b><br>
                    <input type="number" name="nlicenciatran" class="form-control" value="<?php echo $veh[0]['NoLicenciatrancito'];?>">
                </label>
                <label class="form-label">
                    <b>Fecha matricula</b><br>
                    <input type="date" name="fmatricula" class="form-control" value="<?php echo $veh[0]['FechaMatricula'];?>">
                </label>
                <label class="form-label">
                    <b>Cargar PDF licencia trancito</b><br>
                    <input name="filelicenciatran" class="form-control" type="file" id="formFile" value="<?php echo $veh[0]['ArchiLicenciaTrancito'];?>">
                </label>   
            </div>
        </div>
    </div>
    <br>
        <input type="submit" name="update" value="ACTUALIZAR" class="btn btn-dark w-50">

    </form>
</div>
  <br>


    <?php require('partials/footer.php') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
  </body>
</html>
<?php

    if(isset($_POST['update']))
    {
        
        $veh=$vehi->updatevehiculo($_POST);

    }
?>