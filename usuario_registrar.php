<?php
include('conexion.php');

$nombre = $_POST["txtnombre1"];
$correo = $_POST["txtcorreo1"];
$pass     = $_POST["txtpassword1"];

if (mysqli_num_rows(mysqli_query($conn, "SELECT correo FROM usuarios WHERE correo = '$correo'")) >= 1) {
    echo "<script>alert('El correo electrónico ya existe'); window.location='index.php'</script>";
} else {
    $insertarusu = mysqli_query($conn, "INSERT INTO usuarios(nom,correo,pass) values ('$nombre','$correo','$pass')");

    if ($insertarusu) {
        echo "<script> alert('Usuario registrado con exito: $nombre'); window.location='index.php' </script>";
    }
}
