<?php
include('../conexion.php');
include("../alumnos_tabla.php");

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
					<th colspan="2">Agregar alumnos</th>
				</tr>
				<tr>
					<td>Nombre</td>
					<td><input type="text" name="txtnom" autocomplete="off" class="CajaTexto"></td>
				</tr>
				<tr>
					<td colspan="2">
						<select id="semestre" name="semestre">
							<option value="">Selecciona un semestre</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<?php echo "<a class='BotonesTeam' href=\"../alumnos_tabla.php?pag=$pagina\">Cancelar</a>"; ?>&nbsp;
						<input class='BotonesTeam' type="submit" name="btnregistrar" value="Registrar" onClick="javascript: return confirm('¿Deseas registrar a este alumno?');">
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>

</html>
<?php

if (isset($_POST['btnregistrar']) && (isset($_POST['semestre']) && $_POST['semestre'] != "")) {
	$nombre 	= $_POST['txtnom'];
	$semestre = $_POST['semestre'];

	$queryadd	= mysqli_query($conn, "INSERT INTO alumnos(nombre, semestre) VALUES('$nombre', '$semestre')");

	if (!$queryadd) {
		echo "<script>alert('¡Error!, intenta otra vez');</script>";
	} else {
		echo "<script>window.location='../alumnos_tabla.php?pag=1' </script>";
	}
}
?>