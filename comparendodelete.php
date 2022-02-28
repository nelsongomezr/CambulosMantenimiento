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
print_r($_GET['id']);
require('class/class.php');
$delete= new comparendo;
$delet=$delete->deletecomparendo($_GET['id']);

?>