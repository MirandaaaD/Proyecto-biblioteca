<?php
include('./conexion.php');
include("./alumnos_tabla.php");

$pagina = $_GET['pag'];
$id = $_GET['id'];

$querybuscar = mysqli_query($conn, "SELECT * FROM alumnos WHERE id = '$id'");

while ($fila = mysqli_fetch_array($querybuscar)) :

?>
<html>
<body>
    <div class="caja_popup2">
        <form class="contenedor_popup" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <th colspan="2">Modificar alumno</th>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td><input class="CajaTexto" type="text" name="txtnombre" value="<?php echo $fila['nombre'] ?>" required></td>
                </tr>
                <tr>
                    <td>Grupo</td>
                    <td><input class="CajaTexto" type="text" name="txtgrupo" value="<?php echo $fila['grupo'] ?>" required></td>
                </tr>
                <tr>
                    <td>Semestre</td>
                    <td><input class="CajaTexto" type="number" name="semestre" value="<?php echo $fila['semestre'] ?>" required></td>
                </tr>
                <tr>
                    <td>No. Control</td>
                    <td><input class="CajaTexto" type="number" name="txtcontrol" value="<?php echo $fila['control']; ?>" required></td>
                </tr>
                <tr>
                    <td>Edad</td>
                    <td><input class="CajaTexto" type="number" name="txtedad" value="<?php echo $fila['edad']; ?>" required></td>
                </tr>
                <tr>
                    <td>No. Telefono</td>
                    <td><input class="CajaTexto" type="text" name="txttele" value="<?php echo $fila['telefono']; ?>" required></td>
                </tr>
                <tr>
                    <td>CURP</td>
                    <td><input class="CajaTexto" type="text" name="txtcurp" value="<?php echo $fila['curp']; ?>" required></td>
                </tr>
                <tr>
                    <td>Foto</td>
                    <td><label for="image"></label><input class="CajaTexto" type="file" id="image" name="image"></label></td>
                </tr>

                    <td colspan="2">
                        <?php echo "<a class='BotonesTeam' href=\"./alumnos_tabla.php?pag=$pagina\">Cancelar</a>"; ?>&nbsp;
                        <input class="BotonesTeam" type="submit" name="btnmodificar" value="Modificar" onClick="javascript: return confirm('¿Deseas modificar a este alumno?');">
                        <?php 
                            $rutacompleta="./img/";
                            if (isset($_FILES['image']) && $_FILES['image']['size'] > 0 /*&& $_FILES['image']['error'] === UPLOAD_ERR_OK*/) {
                                $archivo 		= $_FILES['image']['tmp_name'];
                                $img 	= $_FILES['image']['name'];
                                $tipoarchivo 	= GetImageSize($archivo);
                                // 1=>'GIF'
                                // 2=>'JPEG'
                                // 3=>'PNG'
                                
                                if (!move_uploaded_file($archivo, $rutacompleta.$img)) {
                                    echo "<script> alert('Error.\\nNo se ha podido cargar el archivo.');</script>"; 
                                }
                            } else {
                                // Handle the case where 'img' key is not set or there's an error with the file upload
                                echo "No file uploaded or error occurred.";
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
    $nombre     = $_POST['txtnombre'];
    $semestre = $_POST['semestre'];
    $grupo = $_POST['txtgrupo'];
    $control = $_POST['txtcontrol'];
    $edad = $_POST['txtedad'];
    $tele = $_POST['txttele'];
    $curp = $_POST['txtcurp'];
    $img = $_FILES['image']['name'];

    $querymodificar = mysqli_query($conn, "UPDATE alumnos SET nombre = '$nombre', semestre = '$semestre', grupo = '$grupo', `control` = '$control', edad = '$edad', telefono = '$tele', curp = '$curp', foto ='$img' WHERE id = '$id'");
    echo "<script>window.location='./alumnos_tabla.php?pag=".$pagina."' </script>";
}
?>