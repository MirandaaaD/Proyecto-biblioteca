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
            $sqlcat = mysqli_query($conn, "SELECT prestamo.id, id_estudiante, id_libro, alumnos.nombre, libros.titulo, fecha_pres, fecha_dev FROM prestamo, alumnos, libros WHERE prestamo.id_estudiante = alumnos.id AND prestamo.id_libro = libros.id AND libros.titulo = '" . $buscar . "' OR alumnos.nombre = '" . $buscar . "'");
        } else {
            $sqlcat = mysqli_query($conn, "SELECT prestamo.id, id_estudiante, id_libro, alumnos.nombre, libros.titulo, fecha_pres, fecha_dev FROM prestamo, alumnos, libros WHERE prestamo.id_estudiante = alumnos.id AND prestamo.id_libro = libros.id ORDER BY id ASC LIMIT " . (($pagina - 1) * $filasmax)  . "," . $filasmax);
        }

        $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_prestamo FROM prestamo, alumnos, libros WHERE prestamo.id_estudiante = alumnos.id AND prestamo.id_libro = libros.id");

        $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_prestamo'];

        ?>
        <div class="ContenedorTabla">
            <form method="POST">
                <h1>Lista de prestamo</h1>
                <div class="ContBuscar">
                    <div style="float: left;">
                        <a href="prestamo_tabla.php" class="BotonesTeam">Inicio</a>
                        <input class="BotonesTeam" type="submit" value="Buscar" name="btnbuscar">
                        <input class="CajaTextoBuscar" type="text" name="txtbuscar" placeholder="Ingresar alumno" autocomplete="off">
                    </div>
                    <div style="float:right">
                        <?php echo "<a class='BotonesTeam5' href=\"./prestamo/prestamo_registrar.php?pag=$pagina\">Agregar Prestamo</a>"; ?>
                    </div>
                </div>
            </form>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Estudiante</th>
                    <th>Libro</th>
                    <th>Fecha del prestamo</th>
                    <th>Fecha de devolucion</th>
                    <th>A tiempo</th>
                    <th>Acción</th>

                </tr>
                <?php while ($fila = mysqli_fetch_assoc($sqlcat)) : ?>

                    <tr>
                        <td><?php echo $fila['id'] ?></td>
                        <td><?php echo $fila['nombre'] ?></td>
                        <td><?php echo $fila['titulo'] ?></td>
                        <td><?php echo $fila['fecha_pres'] ?></td>
                        <td><?php echo $fila['fecha_dev'] ?></td>
                        <td><?php if($fila['fecha_dev'] <  date("Y-m-d")){echo "&#10060;";} else{echo "&#9989;";} ?></td>

                    <?php
                    echo "<td style='width:24%'>
				<a class='BotonesTeam1' href=\"./prestamo/prestamo_ver.php?id=$fila[id]&pag=$pagina\">&#x1F50D;</a> 
				<a class='BotonesTeam2' href=\"./prestamo/prestamo_modificar.php?id=$fila[id]&pag=$pagina&id1=$fila[id_estudiante]&id2=$fila[id_libro]\">&#128397;</a> 
				<a class='BotonesTeam3' href=\"./prestamo/prestamo_eliminar.php?id=$fila[id]&pag=$pagina\" onClick=\"return confirm('¿Estás seguro de devolver el libro $fila[titulo]?')\">&#128213;</a></td>";
                    echo "</tr>";
                endwhile;

                    ?>
            </table>
            <div style='text-align:right'>
                <br>
                <?php echo "Total de prestamo: " . $maxusutabla; ?>
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
                    <a class="BotonesTeam4" href="prestamo_tabla.php?pag=<?php echo $_GET['pag'] - 1; ?>">Anterior</a>
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
                    <a class="BotonesTeam4" href="prestamo_tabla.php?pag=<?php echo $_GET['pag'] + 1; ?>">Siguiente</a>
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
                <a class="BotonesTeam4" href="prestamo_tabla.php?pag=2">Siguiente</a>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>