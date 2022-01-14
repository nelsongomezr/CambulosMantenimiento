<?php
session_gc();
session_destroy();
header('index.php');
?>