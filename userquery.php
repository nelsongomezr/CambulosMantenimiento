<?php
// valida inicio de session
session_start();
if($_SESSION==null || $_SESSION=="")
{
    echo "<script type='text/javascript'>
    alert('usted no tiene acceso permitido');
    window.location='index.php';
    </script>";
    die();
}
//fin valida inicio de session

require('class/class.php');
$nav=new rol;
$query=new user;
if(isset($_POST['condoc']))
{
    if($_POST['consulta']==1)
    {
        $id=$_POST['doc'];
        $quer=$query->queryuser($id);
        if(sizeof($quer)=="")
        {
            echo "<script type='text/javascript'>
                alert('El documento de identificacion no esta registrado');
                window.location='userquery.php';
                </script>";
        }
    }
    if($_POST['consulta']==2)
    {
        $nom=$_POST['doc'];
        $quer=$query->quereyusername($nom);
        if(sizeof($quer)=="")
        {
            echo "<script type='text/javascript'>
                alert('El nombre no esta registrado');
                window.location='userquery.php';
                </script>";
        }
    }
    if($_POST['consulta']=="")
    {
        echo "<script type='text/javascript'>
                alert('debe seleccionar el tipo de busqueda');
                window.location='userquery.php';
                </script>";
    }
}
if(isset($_POST['congeneral']))
{
    $quer=$query->queryalluser();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Consulta usuarios</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<?php 
// Carga el NAV correspondiente al rol
$na=$nav->navrol($_SESSION['rol'])
// fin Carga el NAV correspondiente al rol
?>
    <center>
        <br>
    <div class="container">
        <div class="card-footer text-muted bg-dark">
            <div class="card-header">
            <h1>CONSULTA USUARIOS</h1>
            </div>
            <div class="card-footer text-muted bg-dark">
                <form method="POST">
                <div class="mb-3 ">
                    <input type="text" name="doc" placeholder="Digtite nombre, apellido o documento id" class="form-control w-50" id="caja_busqueda">
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    
    <div class="container" >
        <hr>
        <div class="table-responsive" id="datos">
            
        </div>
    </div>
    </center>
    <br>
    <?php 
    //inserta el footer
    require('partials/footer.php');
    //fin inserta el footer ?>
    <!--bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <!--fin bootstrap-->
    <!--ajax-->
    <script src="js/index.js"></script>
    <!--fin ajax-->
</body>
</html>