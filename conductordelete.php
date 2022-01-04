<?php 
    $id=$_GET['id'];
    require('class/class.php');
    $delet=new conductor;
    $del=$delet->deleteconductor($id);
?>