<?php
include('../conexion.php');
include("../prestamo_tabla.php");

$pagina = $_GET['pag'];
$id = $_GET['id'];
$id1 = $_GET['id1'];
$id2 = $_GET['id2'];

$sql = mysqli_query($conn, "SELECT id, nombre FROM alumnos");
$sql1 = mysqli_query($conn, "SELECT id, nombre FROM alumnos WHERE id = '$id1'");
$sql2 = mysqli_query($conn, "SELECT id, titulo FROM libros");
$sql3 = mysqli_query($conn, "SELECT id, titulo FROM libros WHERE id = '$id2'");
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
                    <th colspan="2">Modificar prestamos</th>
                </tr>
                <tr>
                    <td>Estudiante</td>
                    <td>
                        <select name="estudiante" id="estudiante">
                            <?php while ($f = mysqli_fetch_array($sql1)) { ?>
                                <option value="<?php echo $f['id']; ?>"><?php echo $f['nombre']; ?></option>
                            <?php } ?>

                            <?php while ($f = mysqli_fetch_array($sql)) :
                                if ($f['id'] == $_GET['id1']) {
                                    continue;
                                }
                            ?>
                                <option value="<?php echo $f['id'] ?>"><?php echo $f['nombre'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Libro</td>
                    <td>
                        <select name="libro" id="libro">
                            <?php while ($f = mysqli_fetch_array($sql3)) { ?>
                                <option value="<?php echo $f['id']; ?>"><?php echo $f['titulo']; ?></option>
                            <?php } ?>
                            <?php while ($f = mysqli_fetch_array($sql2)) {
                                if ($f['id'] == $_GET['id2']) {
                                    continue;
                                }
                                echo "<option value='" . $f['id'] . "'>" . $f['titulo'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Fecha de devolucion</td>
                    <td><input type="date" name="fecha" class="CajaTexto" min="<?php echo date("Y-m-d") ?>" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo "<a class='BotonesTeam' href=\"../prestamo_tabla.php?pag=$pagina\">Cancelar</a>"; ?>&nbsp;
                        <input class='BotonesTeam' type="submit" name="btnregistrar" value="Modificar" onClick="javascript: return confirm('¿Deseas modificar a este libro?');">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>
<?php

if (isset($_POST['btnregistrar'])) {
    $nombre     = $_POST['estudiante'];
    $libro         = $_POST['libro'];
    $dev         = $_POST['fecha'];

    $queryadd    = mysqli_query($conn, "UPDATE prestamo SET id_estudiante = '$nombre', id_libro = '$libro', fecha_dev = '$dev' WHERE id = '$id'");

    if (!$queryadd) {
        echo "<script>alert('¡Error!, intenta otra vez');</script>";
    } else {
        echo "<script>window.location='../prestamo_tabla.php?pag=1' </script>";
    }
}
?>