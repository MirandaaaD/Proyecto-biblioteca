<?php
include('../conexion.php');
include("../libros_tabla.php");

$pagina = $_GET['pag'];
$id = $_GET['id'];

$querybuscar = mysqli_query($conn, "SELECT * FROM libros WHERE id = '$id'");

while ($fila = mysqli_fetch_array($querybuscar)) :

?>
    <html>
    <link rel="stylesheet" href="../css/style.css">

    <body>
        <div class="caja_popup2">
            <form class="contenedor_popup" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <th colspan="2">Modificar Libro</th>
                    </tr>
                    <tr>
                        <td>Titulo</td>
                        <td><input class="CajaTexto" type="text" name="titulo" value="<?php echo $fila['titulo'] ?>" required></td>
                    </tr>
                    <tr>
                        <td>Autor</td>
                        <td><input class="CajaTexto" type="text" name="autor" value="<?php echo $fila['autor'] ?>" required></td>
                    </tr>
                    <tr>
                        <td>Descripcion</td>
                        <td><input class="CajaTexto" type="text" name="desc" value="<?php echo $fila['descripcion'] ?>" required></td>
                    </tr>
                    <tr>
                        <td>Portada</td>
                        <td><label for="image"><img src="../images/<?php echo $fila['imagen'] ?>" alt="imagen no disponible" width="150px" height="auto"><input class="CajaTexto" type="file" id="image" name="image"></label></td>
                    </tr>

                    <td colspan="2">
                        <?php echo "<a class='BotonesTeam' href=\"../libros_tabla.php?pag=$pagina\">Cancelar</a>"; ?>&nbsp;
                        <input class="BotonesTeam" type="submit" name="btnmodificar" value="Modificar" onClick="javascript: return confirm('¿Deseas modificar a este libro?');">
                        <?php
                        $rutacompleta = "../images/";
                        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0 /*&& $_FILES['image']['error'] === UPLOAD_ERR_OK*/) {
                            $archivo         = $_FILES['image']['tmp_name'];
                            $img     = $_FILES['image']['name'];
                            $tipoarchivo     = GetImageSize($archivo);
                            // 1=>'GIF'
                            // 2=>'JPEG'
                            // 3=>'PNG'

                            if (!move_uploaded_file($archivo, $rutacompleta . $img)) {
                                echo "<script> alert('Error.\\nNo se ha podido cargar el archivo.');</script>";
                            }
                        }
                        $fileimg = opendir($rutacompleta);
                        ?>
                    </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>

    </html>

<?php
endwhile;

if (isset($_POST['btnmodificar'])) {
    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $titulo     = $_POST['titulo'];
        $autor = $_POST['autor'];
        $desc = $_POST['desc'];
        $img = $_FILES['image']['name'];

        $querymodificar = mysqli_query($conn, "UPDATE libros SET titulo = '$titulo', autor = '$autor', descripcion = '$desc', imagen ='$img' WHERE id = '$id'");
        echo "<script>window.location='../libros_tabla.php?pag=" . $pagina . "' </script>";
    } else {
        $titulo     = $_POST['titulo'];
        $autor = $_POST['autor'];
        $desc = $_POST['desc'];

        $querymodificar = mysqli_query($conn, "UPDATE libros SET titulo = '$titulo', autor = '$autor', descripcion = '$desc' WHERE id = '$id'");
        echo "<script>window.location='../libros_tabla.php?pag=" . $pagina . "' </script>";
    }
}
?>