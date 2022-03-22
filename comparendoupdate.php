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
        error_reporting(0); 

            if(empty($_GET['id']))  
         {
             $idco=$_SESSION['comparendo'];
         }
             if(!empty($_GET['id']>0))
         {
             $idco=$_GET['id'];
         }
         
        
    require('class/class.php');
    $nav=new rol;
    $comp= new comparendo;
    $com=$comp->querynrocomparendo($idco);
    //print_r($com);
    if(sizeof($com)>0)
    {
        $id=$com[0]['idConductor'];
    }else
    {
        $com=$comp->querynrocomparendovehi($idco);
        $id=$com[0]['Vehiculo_IdVehiculoo'];
        print_r($com);
    } 
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <title>Modificar comparendos</title>
    </head>
    <body>
    <?php $na=$nav->navrol($_SESSION['rol']) ?>
        <br><center><h1>ACTUALIZACION DATOS COMPARENDOS</h1></center><br>

        <div class="accordion accordion-flush container" id="accordionFlushExample">
            <form method="POST">
            <div class="accordion-item bg-secondary bg-opacity-10">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <b>Modificar comparendo</b>
                    </button>
                </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <form method="POST">
                <div class="accordion-body">
                    <label class="form-label">
                        <label class="form-label">
                        <b>Numero</b><br>
                        <input type="number" name="NroComp" class="form-control" value="<?php echo $com[0]['NroComp'];?>">
                        </label>
                    <label class="form-label">
                        <b>Tipo</b><br>
                        <input type="text" name="Tipo" class="form-control" value="<?php echo $com[0]['TipoComparendo'];?>">
                    </label>
                    <label class="form-label">
                        <b>Fecha</b><br>
                        <input type="date" name="fecha" class="form-control" value="<?php echo $com[0]['Fecha'];?>">
                    </label>
                    <label class="form-label">
                        <b>Secretaria</b><br>
                        <input type="text" name="secretaria" class="form-control" value="<?php echo $com[0]['Secretaria'];?>">
                    </label>
                    <label class="form-label">
                        <b>Infraccion</b><br>
                        <input type="text" name="infraccion" class="form-control" value="<?php echo $com[0]['Infraccion'];?>">
                    </label>
                    <label class="form-label">
                        <b>Estado</b><br>
                        <input type="text" name="estado" class="form-control" value="<?php Echo $com[0]['Estado'];?>">
                    </label>
                    <label class="form-label">
                        <b>Valor</b><br>
                        <input type="text" name="val" class="form-control" value="<?php echo $com[0]['Valor'];?>">       
                    </label>
                    <label class="form-label">
                        <b>Valor a pagar</b><br>
                        <input type="text" name="valapa" class="form-control" value="<?php echo $com[0]['ValorApagar'];?>">
                    </label><br>
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="update" value="ACTUALIZAR" class="btn btn-dark w-50">

                </form>
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
    if(isset($_POST['update']))
    {
        $com=$comp->updatecomparendo($_POST);
    }
    ?>