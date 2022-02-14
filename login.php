<?php

require "controladores/controladorUsuarios.php";

?>


<?php

session_start(); //siempre hay que iniciar sesion

//comprueba que el POST devuelve que se ha clicado en el botón del login con id = "login"
if (isset($_POST["login"])) {
    //llamo a la función que me comprueba si las credenciales son correctas pasandole como parámetro lo que me devuelve el POST
    $usuario = obtenerUsuario($_POST["usuario"], $_POST["password"]);

    if ($usuario) {
        hacerLogin($usuario);
    } else {
        $error = "El usuario o contraseña son incorrectos";
    }
}

?>

<!DOCTYPE html>

<html>

<head>

    <style>
        .signin {
            background-color: #F0F8FF;
            width: 100%;
            text-align: right;
            height: 30px;
            font-family: Arial, Helvetica, sans-serif;
            padding-right: 30px;

        }
    </style>
    <title>Log in Actividades</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="signin">
        <a class="signin" href="signin.php"> Sign in</a>
    </div>
    <div class="container p-5 my-5">
        <!-- container central-->
        <div class="row">
            <!-- disposición en grid-->
            <div class="col-sm pb-5 border text-body">
                <!-- columna 1-->
                <div class="container-fluid">
                    <h1>Creador de Actividades</h1>
                    <p>Crea actividades a tu gusto.</p>
                </div><!-- encabezado-->

                <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="mb-3 mt-3">
                        <label for="usuario" class="form-label">Usuario:</label>
                        <input type="usuario" class="form-control" id="usuario" placeholder="Introduce usuario" name="usuario">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" id="password" placeholder="Introduce contraseña" name="password">
                    </div>
                    <input class="btn btn-primary" type="submit" value="Log in" name="login">
                    <div class="mb-3 mt-3 text-danger">
                        <?php
                        if (isset($error)) {
                            echo  "*" . $error;
                        }
                        ?>
                    </div>
                </form>

            </div><!-- columna 1-->
        </div> <!-- disposición en grid-->
    </div>

</body>

</html>