<?php
session_start();
include('conexion.php');
if (isset($_SESSION['usuario'])) {
    header('location: calificaciones_tabla.php');
}
?>

<html>

<head>
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="FormCajaLogin">

        <div class="FormLogin">

            <div class="botondeintercambiar">
                <div id="btnvai"></div>
                <button type="button" class="botoncambiarcaja" onclick="loginvai()" id="vaibtnlogin">Login</button>
                <button type="button" class="botoncambiarcaja" onclick="registrarvai()" id="vaibtnregistrar">Registrar</button>
            </div>

            <!-- formulario login -->
            <form method="POST" id="frmlogin" class="grupo-entradas" action="usuario_login.php">
                <h1>Iniciar sesión</h1>

                <div class="TextoCajas">• Ingresar correo</div>
                <input type="email" name="txtcorreo" class="CajaTexto" autocomplete="off" required>

                <div class="TextoCajas">• Ingresar password</div>
                <input type="password" name="txtpassword" class="CajaTexto" autocomplete="off" required>

                <div>
                    <input type="submit" value="Iniciar sesión" class="BtnLogin" name="btningresar">
                </div>

            </form>

            <!-- formulario registrar -->
            <form method="post" id="frmregistrar" class="grupo-entradas" action="usuario_registrar.php">
                <h1>Crear nueva cuenta</h1>

                <div class="TextoCajas">• Ingresar nombre</div>
                <input type="text" name="txtnombre1" class="CajaTexto" autocomplete="off" required>

                <div class="TextoCajas">• Ingresar correo</div>
                <input type="email" name="txtcorreo1" class="CajaTexto" autocomplete="off" required>

                <div class="TextoCajas">• Ingresar password</div>
                <input type="password" name="txtpassword1" class="CajaTexto" autocomplete="off" required>

                <div>
                    <input type="submit" value="Crea nueva cuenta" class="BtnRegistrar" name="btnregistrar">
                </div>

            </form>
        </div>
    </div>

</body>
<script src="scripts.js"></script>

</html>