<?php
session_start();
require("class/class.php");
$rols= new Rol;
$query=new vehiculo;
$vehi=$query->queryvehiculoplaca($_GET['id']); 
$id=$vehi[0]['idVehiculo'];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Registro vehiculos</title>
  </head>
  <body>
    <?php $ro=$rols->navrol($_SESSION['rol']); ?>
    <br>
    <center><h1><?php echo $vehi[0]['Placa'] ?></h1></center>
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
                <input type="text" name="placa" class="form-control" value="<?php echo $vehi[0]['Placa'];?>" disabled>
            </label>
            <label class="form-label">
                <b>Marca</b><br>
                <input type="text" name="Marca" class="form-control" value="<?php echo $vehi[0]['Marca'];?>" disabled>
            </label>
            <label class="form-label">
                <b>Linea</b><br>
                <input type="text" name="linea" class="form-control" value="<?php echo $vehi[0]['Linea'];?>" disabled>
            </label>
            <label class="form-label">
                <b>Modelo</b><br>
                <input type="number" name="modelo" class="form-control" value="<?php echo $vehi[0]['modelo'];?>" disabled>
            </label>
            <label class="form-label">
                <b>Color</b><br>
                <input type="text" name="color" class="form-control" value="<?php echo $vehi[0]['Color'];?>" disabled>
            </label>
      </div>

        <div class="accordion-body">

            <label class="form-label">
                <b>Servicio</b><br>
                <input type="text" name="Servicio" class="form-control" value="<?php echo $vehi[0]['Servicio'];?>" disabled>
            </label>
            <label class="form-label">
                <b>Clase de vehiculo</b><br>
                <input type="text" name="clase" class="form-control" value="<?php echo $vehi[0]['ClaseVehiculo'];?>" disabled >
            </label>
            <label class="form-label">
                <b>Tipo carroceria</b><br>
                <input type="text" name="carroceria" class="form-control" value="<?php echo $vehi[0]['TipoCarroceria'];?>" disabled>
            </label>
            <label class="form-label">
                <b>Capacidad carga (Kg)</b><br>
                <input type="number" name="carga" class="form-control" value="<?php echo $vehi[0]['CapacidadCarga'];?>" disabled>
            </label>
            <label class="form-label">
                <b>Peso bruto vehiculo (Kg)</b><br>
                <input type="number" name="pesobruto" class="form-control" value="<?php echo $vehi[0]['PesoBruto'];?>" disabled>
            </label>

        </div>

        <div class="accordion-body">

            <label class="form-label">
                <b>Tipo direccion</b><br>
                <input type="text" name="direccion" class="form-control" value="<?php echo $vehi[0]['TipoDireccion'];?>" disabled>
            </label>
            <label class="form-label">
                <b>Numero de chasis</b><br>
                <input type="text" name="nchasis" class="form-control" value="<?php echo $vehi[0]['NoChasis'];?>" disabled>
            </label>
            <label class="form-label">
                <b>Numero de VIM</b><br>
                <input type="text" name="nVIM" class="form-control" value="<?php echo $vehi[0]['NoVim'];?>" disabled>
            </label>
            <label class="form-label">
                <b>Actividad del vehiculo</b><br>
                <input type="text" class="form-control" value="<?php echo $vehi[0]['UsoVheiculocol'];?>" disabled>
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
                <input type="number" name="cilindraje" class="form-control" value="<?php echo $vehi[0]['Cilindraje'];?>" disabled>
            </label>
            <label class="form-label">
                <b>Numero de motor</b><br>
                <input type="text" name="nmotor" class="form-control" value="<?php echo $vehi[0]['NumeroMotor'];?>" disabled>
            </label>
            <label class="form-label">
                <b>Tipo combustible</b><br>
                <input type="text" name="combustible" class="form-control" value="<?php echo $vehi[0]['Combustible'];?>" disabled>
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
                <input type="number" name="nejes" class="form-control" value="<?php echo $vehi[0]['NoEjes'];?>" disabled>
            </label>
            <label class="form-label">
                <b>Longitud total (mm)</b><br>
                <input type="number" name="ltotal" class="form-control" value="<?php echo $vehi[0]['LongitudTotal'];?>" disabled>
            </label>
            <label class="form-label">
                <b>Alto (mm)</b><br>
                <input type="number" name="alto" class="form-control" value="<?php echo $vehi[0]['Alto'];?>" disabled>
            </label>
            <label class="form-label">
                <b>Ancho (mm)</b><br>
                <input type="number" name="ancho" class="form-control" value="<?php echo $vehi[0]['Ancho'];?>" disabled>
            </label>
            <label class="form-label">
                <b>Distancia entre ejes (mm)</b><br>
                <input type="number" name="dejes" class="form-control" value="<?php echo $vehi[0]['DistaEntreEjes'];?>" disabled>
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
                    <input type="number" name="nllantas" class="form-control" value="<?php echo $vehi[0]['NoLlantas'];?>" disabled>
                </label>
                <label class="form-label">
                    <b>Dimensiones llantas</b><br>
                    <input type="text" name="Dllantas" class="form-control" value="<?php echo $vehi[0]['DimensionLLanta'];?>" disabled>
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
                    <input type="text" name="nsoat" class="form-control" value="<?php echo $vehi[0]['PolizaSoat'];?>" disabled>
                </label>
                <label class="form-label">
                    <b>Fecha vencimiento</b><br>
                    <input type="text" name="fsoat" class="form-control" value="<?php echo $vehi[0]['VenceSoat'];?>" disabled>
                </label>
                <label class="form-label">
                    <button type="button" class="btn btn-light">
                      <a href="<?php echo $vehi[0]['ArchSoat'];?>"><b>Ver SOAT</b></a>
                  </button> 
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
                <input type="text" name="ntecnico" class="form-control" value="<?php echo $vehi[0]['NoTecnicomecanica'];?>" disabled>
            </label>
            <label class="form-label">
                <b>Fecha vencimiento</b><br>
                <input type="text" name="ftecnico" class="form-control" value="<?php echo $vehi[0]['VenceTecnicomecanica'];?>" disabled>
            </label>
            <label class="form-label">
                  <button type="button" class="btn btn-light">
                    <a href="<?php echo $vehi[0]['ArchiTecnicomecanica'];?>"><b>Ver Tecnicomecanica</b></a>
                  </button> 
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
                    <input type="text" name="ncontractual" class="form-control" value="<?php echo $vehi[0]['polizacontraactual'];?>" disabled>
                </label>
                <label class="form-label">
                    <b>Fecha vencimiento</b><br>
                    <input type="date" name="fcontractual" class="form-control" value="<?php echo $vehi[0]['VencePolizaContraactual'];?>" disabled>
                </label>
                <label class="form-label">
                    <button type="button" class="btn btn-light">
                    <a href="<?php echo $vehi[0]['archPolizaContraActual'];?>"><b>Ver Poliza contractual</b></a>
                  </button>    
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
                    <input type="number" name="nlicenciatran" class="form-control" value="<?php echo $vehi[0]['NoLicenciatrancito'];?>" disabled>
                </label>
                <label class="form-label">
                    <b>Fecha matricula</b><br>
                    <input type="text" name="fmatricula" class="form-control" value="<?php echo $vehi[0]['FechaMatricula'];?>" disabled>
                </label>
                <label class="form-label">
                  <button type="button" class="btn btn-light">
                    <a href="<?php echo $vehi[0]['ArchiLicenciaTrancito'];?>"><b>Ver licencia de transito</b></a>
                  </button>    
                </label>   
            </div>
        </div>
    </div>
    <div class="accordion-item bg-secondary bg-opacity-10">
        <h2 class="accordion-header" id="flush-headingNine">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
            <b>Informacion adicional</b>
        </button>
        </h2>
        <div id="flush-collapseNine" class="accordion-collapse collapse" aria-labelledby="flush-headingNine" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">

                <button type="button" class="btn btn-light">
                <?php echo'<a href=reportecomparendos.php?id='.$id.'>' ?><b>Reporte comparendos</b></a>
                </button>
                <button type="button" class="btn btn-light">
                    <a href="#"><b>Reporte de incidentes</b></a>
                </button>
                <button type="button" class="btn btn-light">
                    <a href="#"><b>Reporte accidentes</b></a>
                </button>
                <button type="button" class="btn btn-light">
                    <a href="#"><b>Plan de mantenimiento preventivo</b></a>
                </button>

            </div>
        </div>
    </div>
    <br>
    </form>
</div>
  <br>


    <?php require('partials/footer.php') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
</html>
<?php
?>