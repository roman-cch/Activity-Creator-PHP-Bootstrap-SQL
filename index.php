<?php
require "actividad.php";
require "controladores/controladorUsuarios.php";
require "controladores/controladorActividades.php";
?>

<?php

session_start(); //siempre iniciamos la sesión, sin condiciones
comprobarLogin(); //comprueba si el login es correcto, si no, nos dirige a la pantalla de login
comprobarCreacionActividad();


?>
<!DOCTYPE HTML>
<html lang="es">

<head>
  <style>
    .logout {
      background-color: #F0F8FF;
      width: 100%;
      text-align: right;
      height: 30px;
      font-family: Arial, Helvetica, sans-serif;
      padding-right: 30px;

    }
  </style>

  <title>Creador de actividades</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div class="logout">
    <?php
    //le pedimos que del usuario de la sesión nos de el nombre
    echo $_SESSION["usuario"]["Nombre"]
    ?>
    <a class="logout" href="logout.php"> Salir</a>
  </div>


  <div class="container-fluid  bg-primary text-white text-center">
    <h1>Creador de Actividades</h1>
    <p>Crea actividades a tu gusto.</p>
  </div><!-- encabezado-->


  <div class="container p-5 my-5">
    <!-- container central-->
    <div class="row">
      <!-- disposición en grid-->
      <div class="col-sm pb-5 border text-body">
        <!-- columna 1-->
        <h2>Nueva actividad:</h2>


        <!-- formulario-->
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="mb-3 mt-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="titulo" class="form-control" id="titulo" placeholder="Introduce título" name="titulo">
          </div>
          <div class="mb-3">
            <label for="fecha" class="form-label">Fecha:</label>
            <input type="date" class="form-control" id="fecha" placeholder="Introduce fecha" name="fecha">
          </div>
          <div class="mb-3">
            <label for="Ciudad" class="form-label">Ciudad:</label>
            <input type="ciudad" class="form-control" id="ciudad" placeholder="Introduce ciudad" name="ciudad">
          </div>

          <div class="mb-3">
            <!-- menu seleccion-->
            <label for="tipo" class="form-label">Tipo de actividad</label>
            <select class="form-select" id="tipo" name="tipo">
              <option>-</option>
              <option>Cine</option>
              <option>Comida</option>
              <option>Copas</option>
              <option>Cultura</option>
              <option>Música</option>
              <option>Viajes</option>
            </select>
          </div>

          <!-- radios-->
          <div class="form-check">
            <input type="radio" class="form-check-input" id="radio1" name="coste" value="Gratis" checked <?php if (isset($_POST["coste"]) && $_POST["coste"] == "Gratis"); ?>>Gratis
            <label class="form-check-label" for="radio1"></label>
          </div>
          <div class="form-check">
            <input type="radio" class="form-check-input" id="radio2" name="coste" value="De Pago" <?php if (isset($_POST["coste"]) && $_POST["coste"] == "De Pago"); ?>>De pago

            <br><br>

            <label class="form-check-label" for="radio2"></label>
            <!-- submit-->
            <input class="btn btn-primary" type="submit" value="Crear actividad" name="crearActividad">
        </form>
      </div><!-- columna 1-->
    </div> <!-- disposición en grid-->



    <div class="col-sm border text-body ">
      <!-- segunda columna, Actividad creada-->

      <?php

      $actividades = listarActividades();

      foreach ($actividades as $actividad) :
      ?>

        <h2>Actividad creada: </h2>

        <?php if (isset($actividad)) : ?>
          <div class="card col-10 border-info mb-3">
            <?php if ($actividad-> tipo != "") : ?>
              <img class="card-img-top" src="./imagenes/<?php echo $actividad-> tipo; ?>.jpg">
            <?php endif ?>
            <ul class="list-group list-grupu-flush">
              <b>
                <li class="list-group-item"><?php echo $actividad-> titulo ?></li>
              </b>
              <li class="list-group-item"><?php echo $actividad-> fecha ?></li>
              <li class="list-group-item"><?php echo $actividad-> ciudad ?></li>
              <li class="list-group-item"><?php echo $actividad-> tipo ?></li>
              <li class="list-group-item"><?php echo $actividad-> coste ?></li>
              <li class="list-group-item">Creada por: <?php echo $actividad-> usuario ?></li>
              

            </ul>
          </div>
        <?php endif ?>
      <?php endforeach ?>
    </div><!-- segunda columna, Actividad creada-->
  </div><!-- container central-->
</body>

</html>