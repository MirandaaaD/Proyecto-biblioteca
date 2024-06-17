<?php
session_start();
include('conexion.php');
if (isset($_SESSION['usuario'])) {
	$usuarioingresado = $_SESSION['usuario'];
	$buscandousu = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo = '" . $usuarioingresado . "'");
	$mostrar = mysqli_fetch_array($buscandousu);
} else {
	header('location: index.php');
}

?>

<html>

<head>
	<title>crud4AMP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<div class="BarraLateral">
		<ul>
			<li><a href="prestamo_tabla.php">Prestamos</a></li>
			<li><a href="libros_tabla.php">Libros</a></li>
			<li><a href="alumnos_tabla.php">Alumnos</a></li>
			<li><a href="cerrar_sesion.php">Cerrar sesión</a></li>
		</ul>
		<hr>
	</div>
</body>

</html>