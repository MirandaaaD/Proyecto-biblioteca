<?php
include('../conexion.php');
include("../barra_lateral.php");
$pagina = $_GET['pag'];
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM alumnos WHERE id='$id'");
header("Location:../alumnos_tabla.php?pag=$pagina");