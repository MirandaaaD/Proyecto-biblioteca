<?php
include('../conexion.php');
include("../prestamo_tabla.php");

$pagina = $_GET['pag'];

$sql = mysqli_query($conn , "SELECT id, nombre FROM alumnos");
$sql2 = mysqli_query($conn , "SELECT id, titulo FROM libros");
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
					<th colspan="2">Agregar prestamos</th>
				</tr>
				<tr>
					<td>Estudiante</td>
					<td>
						<select name="estudiante" id="estudiante">
							<?php
							while ($f = mysqli_fetch_array($sql)):?>
								<option value="<?php echo $f['id']?>"><?php echo $f['nombre']?></option>
							<?php endwhile;
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Libro</td>
					<td>
					<select name="libro" id="libro">
							<?php
							while ($f = mysqli_fetch_array($sql2)) {
								echo "<option value='".$f['id']."'>".$f['titulo']."</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Fecha de devolucion</td>
					<td><input type="date" name="fecha" class="CajaTexto" min="<?php echo date("Y-m-d")?>" required></td>
				</tr>
				<tr>
					<td colspan="2">
						<?php echo "<a class='BotonesTeam' href=\"../prestamo_tabla.php?pag=$pagina\">Cancelar</a>"; ?>&nbsp;
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
	$nombre 	= $_POST['estudiante'];
	$libro 		= $_POST['libro'];
	$pres		= date("Y-m-d");
	$dev 		= $_POST['fecha'];

	$queryadd	= mysqli_query($conn, "INSERT INTO prestamo(id_estudiante, id_libro, fecha_pres, fecha_dev) VALUES('$nombre', '$libro', '$pres', '$dev')");

	if (!$queryadd) {
		echo "<script>alert('¡Error!, intenta otra vez');</script>";
	} else {
		echo "<script>window.location='../prestamo_tabla.php?pag=1' </script>";
	}
}
?>