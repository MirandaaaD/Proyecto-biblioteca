<?php
include('../conexion.php');
include("../barra_lateral.php");

$pagina = $_GET['pag'];
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM libros WHERE id='$id'");
header("Location:../libros_tabla.php?pag=$pagina");