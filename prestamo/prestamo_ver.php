<?php
include('../conexion.php');
include("../prestamo_tabla.php");

$pagina = $_GET['pag'];
$id = $_GET['id'];

$sql = mysqli_query($conn, "SELECT prestamo.id, alumnos.nombre, libros.titulo, fecha_pres, fecha_dev FROM prestamo, alumnos, libros WHERE prestamo.id_estudiante = alumnos.id AND prestamo.id_libro = libros.id");

while ($mostrar = mysqli_fetch_array($sql)) {
	$id	= $mostrar['id'];
	$nombre = $mostrar['nombre'];
	$titulo = $mostrar['titulo'];
	$fecha_pres = $mostrar['fecha_pres'];
	$fecha_dev = $mostrar['fecha_dev'];
	$esta = $mostrar['fecha_dev'] <  date("Y-m-d")? "&#10060;" : "&#9989;";
}
?>

<html>
<link rel="stylesheet" href="../css/style.css">
<body>
    <div class="caja_popup2">
        <form class="contenedor_popup" method="POST">
            <table>
                <tr>
                    <th colspan="2">Ver Prestamo</th>
                </tr>
                <tr>
                    <td><b>Id:</b></td>
                    <td><?php echo $id ?></td>
                </tr>
                
                <tr>
                    <td><b>Estudiante: </b></td>
                    <td><?php echo $nombre ?></td>
                </tr>

                <tr>
                    <td><b>Titulo: </b></td>
                    <td><?php echo $titulo ?></td>
                </tr>

                <tr>
                    <td><b>Fecha del prestamo: </b></td>
                    <td><?php echo $fecha_pres ?></td>
                </tr>

                <tr>
                    <td><b>Fecha de devolucion: </b></td>
                    <td><?php echo $fecha_dev ?></td>
                </tr>

                <tr>
                    <td><b>A tiempo: </b></td>
                    <td><?php echo $esta ?></td>
                </tr>

                <td colspan="2">
                    <?php echo '<a class="BotonesTeam1" href="../prestamo_tabla.php?pag='.$pagina.'">Atras</a>' ?>
                </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>