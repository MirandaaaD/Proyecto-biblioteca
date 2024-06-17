<?php
include('conexion.php');
include("barra_lateral.php");
?>
<html>
<title>Document</title>

<body>
	<div class="ContenedorPrincipal">
		<?php

		$filasmax = 7;

		if (isset($_GET['pag'])) {
			$pagina = $_GET['pag'];
		} else {
			$pagina = 1;
		}

		if (isset($_POST['btnbuscar'])) {
			$buscar = $_POST['txtbuscar'];
			$sqlcat = mysqli_query($conn, "SELECT * FROM alumnos WHERE nombre = '" . $buscar . "'");
		} else {
			$sqlcat = mysqli_query($conn, "SELECT * FROM alumnos ORDER BY id ASC LIMIT " . (($pagina - 1) * $filasmax)  . "," . $filasmax);
		}

		$resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_alumnos FROM alumnos");

		$maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_alumnos'];

		?>
		<div class="ContenedorTabla">
			<form method="POST">
				<h1>Lista de alumnos</h1>
				<div class="ContBuscar">
					<div style="float: left;">
						<a href="alumnos_tabla.php" class="BotonesTeam">Inicio</a>
						<input class="BotonesTeam" type="submit" value="Buscar" name="btnbuscar">
						<input class="CajaTextoBuscar" type="text" name="txtbuscar" placeholder="Ingresar alumno" autocomplete="off">
					</div>
					<div style="float:right">
						<?php echo "<a class='BotonesTeam5' href=\"./alumnos/alumnos_registrar.php?pag=$pagina\">Agregar alumno</a>"; ?>
					</div>
				</div>
			</form>
			<table>
				<tr>
					<th>Id</th>
					<th>Nombre</th>
					<th>Semestre</th>
					<th>Grupo</th>
					<th>No. Control</th>
					<th>Edad</th>
					<th>No. Telefono</th>
					<th>CURP</th>
					<th>Foto</th>
					<th>Acción</th>
					
				</tr>
				<?php while ($fila = mysqli_fetch_assoc($sqlcat)) : ?>

				<tr>
					<td><?php echo $fila['id']?></td>
					<td><?php echo $fila['nombre']?></td>
					<td><?php echo $fila['semestre']?></td>
					<td><?php echo $fila['grupo']?></td>
					<td><?php echo $fila['control']?></td>
					<td><?php echo $fila['edad'] ?></td>
					<td><?php echo $fila['telefono'] ?></td>
					<td><?php echo $fila['curp'] ?></td>
					<td><img src="./img/<?php echo $fila['foto']?>" alt="imagen no disponible" width="150px" height="auto"></td>
				<?php
				echo "<td style='width:24%'>
				<a class='BotonesTeam1' href=\"./alumnos/alumnos_ver.php?id=$fila[id]&pag=$pagina\">&#x1F50D;</a> 
				<a class='BotonesTeam2' href=\"./alumnos_modificar.php?id=$fila[id]&pag=$pagina\">&#128397;</a> 
				<a class='BotonesTeam3' href=\"./alumnos/alumnos_eliminar.php?id=$fila[id]&pag=$pagina\" onClick=\"return confirm('¿Estás seguro de eliminar la categoría $fila[nombre]?')\">&#10006;</a></td>";
				echo "</tr>";
				endwhile;

				?>
			</table>
			<div style='text-align:right'>
				<br>
				<?php echo "Total de alumnos: " . $maxusutabla; ?>
			</div>
		</div>
		<div style='text-align:right'>
			<br>
		</div>
		<div style="text-align:center">
		<?php
			if (isset($_GET['pag'])) {
				if ($_GET['pag'] > 1) {
		?>
				<a class="BotonesTeam4" href="alumnos_tabla.php?pag=<?php echo $_GET['pag'] - 1; ?>">Anterior</a>
				<?php
				} else {
				?>
					<a class="BotonesTeam4" href="#" style="pointer-events: none">Anterior</a>
				<?php
				}
				?>

			<?php
			} else {
			?>
				<a class="BotonesTeam4" href="#" style="pointer-events: none">Anterior</a>
				<?php
			}

			if (isset($_GET['pag'])) {
				if ((($pagina) * $filasmax) < $maxusutabla) {
				?>
					<a class="BotonesTeam4" href="alumnos_tabla.php?pag=<?php echo $_GET['pag'] + 1; ?>">Siguiente</a>
				<?php
				} else {
				?>
					<a class="BotonesTeam4" href="#" style="pointer-events: none">Siguiente</a>
				<?php
				}
				?>
			<?php
			} else {
			?>
				<a class="BotonesTeam4" href="alumnos_tabla.php?pag=2">Siguiente</a>
			<?php
			}
			?>
		</div>
	</div>
</body>

</html>