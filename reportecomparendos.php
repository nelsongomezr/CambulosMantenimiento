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
require('class/class.php');
if(empty($_GET['id']))
{
    $id=$_SESSION['varid'];
}else
{
    $id=$_GET['id'];
}
$nav=new rol;
$comp= new comparendo;
$com=$comp->makefindcomp($id);
$simi=$comp->simit($id);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Reporte comparendos</title>
  </head>
  <body>
  <?php $na=$nav->navrol($_SESSION['rol']) ?>
    <br><center><h1>REPORTE COMPARENDOS</h1></center>

    <div class="accordion accordion-flush container" id="accordionFlushExample">
        <form method="POST">
        <div class="accordion-item bg-secondary bg-opacity-10">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <b>Registrar comparendo</b>
                </button>
            </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            <form method="POST">
            <div class="accordion-body">
                <label class="form-label">
                    <label class="form-label">
                    <b>Numero</b><br>
                    <input type="number" name="NroComp" class="form-control">
                    </label>
                <label class="form-label">
                    <b>Tipo</b><br>
                    <input type="text" name="Tipo" class="form-control">
                </label>
                <label class="form-label">
                    <b>Fecha</b><br>
                    <input type="date" name="fecha" class="form-control">
                </label>
                <label class="form-label">
                    <b>Secretaria</b><br>
                    <input type="text" name="secretaria" class="form-control">
                </label>
                <label class="form-label">
                    <b>Infraccion</b><br>
                    <input type="text" name="infraccion" class="form-control">
                </label>
                <label class="form-label">
                    <b>Estado</b><br>
                    <input type="text" name="estado" class="form-control">
                </label>
                <label class="form-label">
                    <b>Valor</b><br>
                    <input type="text" name="val" class="form-control">
                </label>
                <label class="form-label">
                    <b>Valor a pagar</b><br>
                    <input type="text" name="valapa" class="form-control">
                </label><br>
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="regustrar" value="REGISTRAR" class="btn btn-dark w-50">
                <button type="button" class="btn btn-light">
              <a href="https://fcm.org.co/simit/#/estado-cuenta?numDocPlacaProp=<?php echo $simi?>"target='_blank'><b>Realizar consulta en el SIMIT</b></a>
            </button>
            </form>
            </div>
            </div>

            <div class="accordion-item bg-secondary bg-opacity-10">
            <h2 class="accordion-header" id="flush-headingTow">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTow" aria-expanded="false" aria-controls="flush-collapseTow">
                    <b>Reporte historico de comparendos</b>
                </button>
            </h2>
        <div id="flush-collapseTow" class="accordion-collapse collapse" aria-labelledby="flush-headingTow" data-bs-parent="#accordionFlushExample"  >
            <div class="accordion-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                            <th scope="col">#</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Secretaria</th>
                            <th scope="col">Infraccion</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Valor a pagar</th>
                            <th scope="col">Actualizar</th>
                            <th scope="col">Eliminar</th>
                        </thead>
                        <?php
                            for($i=0;$i<sizeof($com);$i++){
                        ?>
                        <tr>
                            <td><?php echo $com[$i]['NroComp']?></td>
                            <td><?php echo $com[$i]['TipoComparendo']?></td>
                            <td><?php echo $com[$i]['Fecha']?></td>
                            <td><?php echo $com[$i]['Secretaria']?></td>
                            <td><?php echo $com[$i]['Infraccion']?></td>
                            <td><?php echo $com[$i]['Estado']?></td>
                            <td><?php echo $com[$i]['Valor']?></td>
                            <td><?php echo $com[$i]['ValorApagar']?></td>
                            <?php $idc=$com[$i]['NroComp'];?>
                            <td><?php echo'<a href=comparendoupdate.php?id='.$idc.'>' ?><img src="img/contrato.png" alt="Actualizar documento" width="30"></a></td>
                            <td><?php echo'<a href=comparendodelete.php?id='.$idc.'>' ?><img src="img/eliminarDocumento.png" alt="Eliminar documento" width="30"></a></a></td>
                        </tr>
                        <?php } ?>
                        <tr><input type="submit" value="ACTUALIZAR" class="btn btn-dark w-50"><tr>
                    </table>
                </div>
            </div>
            </div>
            </div>

        </div>

    </div>
    <br>

    <?php require('partials/footer.php');?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
</html>
<?php

if(isset($_POST['regustrar']))
{
 $inf=$comp->insertcomparendo($_POST);
}

?>