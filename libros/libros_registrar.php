<?php
include('../conexion.php');
include("../libros_tabla.php");

$pagina = $_GET['pag'];
?>
<html>

<head>
	<title>Document</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/style.css">
</head>

<body>
	<div class="caja_popup2">
		<form class="contenedor_popup" method="POST">
			<table>
				<tr>
					<th colspan="2">Agregar libros</th>
				</tr>
				<tr>
					<td>Titulo</td>
					<td><input type="text" name="txtnom" autocomplete="off" class="CajaTexto" required></td>
				</tr>
				<tr>
					<td>Autor</td>
					<td><input type="text" name="autor" autocomplete="off" class="CajaTexto" required></td>
				</tr>
				<tr>
					<td colspan="2">
						<?php echo "<a class='BotonesTeam' href=\"../libros_tabla.php?pag=$pagina\">Cancelar</a>"; ?>&nbsp;
						<input class='BotonesTeam' type="submit" name="btnregistrar" value="Registrar" onClick="javascript: return confirm('¿Deseas registrar a este libro?');">
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>

</html>
<?php

if (isset($_POST['btnregistrar'])) {
	$nombre 	= $_POST['txtnom'];
	$autor 		= $_POST['autor'];

	$queryadd	= mysqli_query($conn, "INSERT INTO libros(titulo, autor) VALUES('$nombre', '$autor')");

	if (!$queryadd) {
		echo "<script>alert('¡Error!, intenta otra vez');</script>";
	} else {
		echo "<script>window.location='../libros_tabla.php?pag=1' </script>";
	}
}
?>