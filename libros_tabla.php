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
			$sqlcat = mysqli_query($conn, "SELECT * FROM libros WHERE titulo = '" . $buscar . "'");
		} else {
			$sqlcat = mysqli_query($conn, "SELECT * FROM libros ORDER BY id ASC LIMIT " . (($pagina - 1) * $filasmax)  . "," . $filasmax);
		}

		$resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_libros FROM libros");

		$maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_libros'];

		?>
		<div class="ContenedorTabla">
			<form method="POST">
				<h1>Lista de libros</h1>
				<div class="ContBuscar">
					<div style="float: left;">
						<a href="libros_tabla.php" class="BotonesTeam">Inicio</a>
						<input class="BotonesTeam" type="submit" value="Buscar" name="btnbuscar">
						<input class="CajaTextoBuscar" type="text" name="txtbuscar" placeholder="Ingresar alumno" autocomplete="off">
					</div>
					<div style="float:right">
						<?php echo "<a class='BotonesTeam5' href=\"./libros/libros_registrar.php?pag=$pagina\">Agregar libro</a>"; ?>
					</div>
				</div>
			</form>
			<table>
				<tr>
					<th>Id</th>
					<th>Titulo</th>
					<th>Autor</th>
					<th>Descripción</th>
					<th>Estado</th>
					<th>Portada</th>
					<th>Acción</th>
					
				</tr>
				<?php while ($fila = mysqli_fetch_assoc($sqlcat)) : ?>

				<tr>
					<td><?php echo $fila['id']?></td>
					<td><?php echo $fila['titulo']?></td>
					<td><?php echo $fila['autor']?></td>
					<td><?php echo $fila['descripcion']?></td>
					<td><?php if ($fila['estado'] == 1) {
                            echo "Disponible";
                        } else {
                            echo "No disponible";
                        }?></td>
					<td><img src="./images/<?php echo $fila['imagen']?>" alt="imagen no disponible" width="150px" height="auto"></td>
				<?php
				echo "<td style='width:24%'>
				<a class='BotonesTeam1' href=\"./libros/libros_ver.php?id=$fila[id]&pag=$pagina\">&#x1F50D;</a> 
				<a class='BotonesTeam2' href=\"./libros/libros_modificar.php?id=$fila[id]&pag=$pagina\">&#128397;</a> 
				<a class='BotonesTeam3' href=\"./libros/libros_eliminar.php?id=$fila[id]&pag=$pagina\" onClick=\"return confirm('¿Estás seguro de eliminar la categoría $fila[titulo]?')\">&#10006;</a></td>";
				echo "</tr>";
				endwhile;

				?>
			</table>
			<div style='text-align:right'>
				<br>
				<?php echo "Total de libros: " . $maxusutabla; ?>
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
				<a class="BotonesTeam4" href="libros_tabla.php?pag=<?php echo $_GET['pag'] - 1; ?>">Anterior</a>
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
					<a class="BotonesTeam4" href="libros_tabla.php?pag=<?php echo $_GET['pag'] + 1; ?>">Siguiente</a>
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
				<a class="BotonesTeam4" href="libros_tabla.php?pag=2">Siguiente</a>
			<?php
			}
			?>
		</div>
	</div>
</body>

</html>