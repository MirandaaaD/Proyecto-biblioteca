<?php
include('../conexion.php');
include("../barra_lateral.php");

$pagina = $_GET['pag'];
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM prestamo WHERE id='$id'");
header("Location:../prestamo_tabla.php?pag=$pagina");