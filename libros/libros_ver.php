<?php
include('../conexion.php');
include("../libros_tabla.php");

$pagina = $_GET['pag'];
$id = $_GET['id'];

$querybuscar = mysqli_query($conn, "SELECT * FROM libros WHERE id = '$id'");

while ($mostrar = mysqli_fetch_array($querybuscar)) {
	$id	= $mostrar['id'];
	$title = $mostrar['titulo'];
	$autor = $mostrar['autor'];
	$desc = $mostrar['descripcion'];
	$estado = $mostrar['estado'];
	$img = $mostrar['imagen'];
}
?>

<html>
<link rel="stylesheet" href="../css/style.css">
<body>
    <div class="caja_popup2">
        <form class="contenedor_popup" method="POST">
            <table>
                <tr>
                    <th colspan="2">Ver libro</th>
                </tr>
                <tr>
                    <td><b>Id:</b></td>
                    <td><?php echo $id ?></td>
                </tr>

                <tr>
                    <td><b>Titulo: </b></td>
                    <td><?php echo $title ?></td>
                </tr>

                <tr>
                    <td><b>Autor: </b></td>
                    <td><?php echo $autor ?></td>
                </tr>

                <tr>
                    <td><b>Descripcion: </b></td>
                    <td><?php echo $desc ?></td>
                </tr>

                <tr>
                    <td><b>Estado: </b></td>
                    <td><?php if ($estado == 1) {
                            echo "Disponible";
                        } else {
                            echo "No disponible";
                        }?></td>
                </tr>

                <tr>
                    <td><b>Portada: </b></td>
                    <td><img src="./images/<?php echo $fila['imagen']?>" alt="imagen no disponible" width="150px" height="auto"></td>
                </tr>
                <td colspan="2">
                    <?php echo '<a class="BotonesTeam1" href="../libros_tabla.php?pag='.$pagina.'">Atras</a>' ?>
                </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>