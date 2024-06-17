<?php
include('../conexion.php');
include("../alumnos_tabla.php");

$pagina = $_GET['pag'];
$id = $_GET['id'];

$querybuscar = mysqli_query($conn, "SELECT * FROM alumnos WHERE id = '$id'");

while ($mostrar = mysqli_fetch_array($querybuscar)) {
	$alumnid	= $mostrar['id'];
	$alumnnom = $mostrar['nombre'];
	$grupo = $mostrar['grupo'];
	$control = $mostrar['control'];
	$edad = $mostrar['edad'];
	$tele = $mostrar['telefono'];
	$curp = $mostrar['curp'];
}
?>

<html>
<link rel="stylesheet" href="../css/style.css">
<body>
    <div class="caja_popup2">
        <form class="contenedor_popup" method="POST">
            <table>
                <tr>
                    <th colspan="2">Ver Alumno</th>
                </tr>
                <tr>
                    <td><b>Id:</b></td>
                    <td><?php echo $alumnid ?></td>
                </tr>

                <tr>
                    <td><b>Nombre: </b></td>
                    <td><?php echo $alumnnom ?></td>
                </tr>

                <tr>
                    <td><b>Semestre: </b></td>
                    <td><?php echo $grupo ?></td>
                </tr>

                <tr>
                    <td><b>Grupo: </b></td>
                    <td><?php echo $control ?></td>
                </tr>

                <tr>
                    <td><b>Turno: </b></td>
                    <td><?php echo $edad ?></td>
                </tr>

                <tr>
                    <td><b>Especialidad: </b></td>
                    <td><?php echo $tele ?></td>
                </tr>

                <tr>
                    <td><b>Especialidad: </b></td>
                    <td><?php echo $curp ?></td>
                </tr>

                <td colspan="2">
                    <?php echo '<a class="BotonesTeam1" href="../alumnos_tabla.php?pag='.$pagina.'">Atras</a>' ?>
                </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>