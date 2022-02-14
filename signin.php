<?php

require "controladores/controladorUsuarios.php";


?>

<?php

session_start();

if (isset($_POST["signin"])) {

    $usuario = crearUsuario($_POST["Id"], $_POST["Correo"], $_POST["Nombre"], $_POST["Contraseña"]);
    $usuario = obtenerUsuario($_POST["Nombre"], $_POST["Contraseña"]);
    hacerLogin($usuario);
}


?>


<!DOCTYPE html>

<html>

<head>
    <title>Log in Actividades</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container p-5 my-5">
        <!-- container central-->
        <div class="row">
            <!-- disposición en grid-->
            <div class="col-sm pb-5 border text-body">
                <!-- columna 1-->
                <div class="container-fluid">
                    <h1>Formulario de registro</h1>
                    <p>Crea actividades a tu gusto.</p>
                </div><!-- encabezado-->

                <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="mb-3 mt-3">
                        <label for="usuario" class="form-label">ID Usuario:</label>
                        <input type="usuario" class="form-control" id="Id" placeholder="Introduce  ID usuario" name="Id">
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo:</label>
                        <input type="correo" class="form-control" id="Correo" placeholder="Introduce correo" name="Correo">
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="nombre" class="form-control" id="Nombre" placeholder="Introduce nombre" name="Nombre">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" id="password" placeholder="Introduce contraseña" name="Contraseña">
                    </div>
                    <input class="btn btn-primary" type="submit" value="Sign in" name="signin">
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