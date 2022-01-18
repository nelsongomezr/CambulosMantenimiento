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
    $id=$_GET['id'];
    require('class/class.php');
    $delet=new conductor;
    $del=$delet->deleteconductor($id);
?>