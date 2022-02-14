

<?php


require "db.php";

?>
<?php

//comprobar si están pidiendo crear una actividad y, si es así, crearla

function comprobarCreacionActividad()
{
    if (
        isset($_POST["crearActividad"]) ||
        $_SERVER['REQUEST_METHOD'] === 'POST'
    ) {

        $nuevaActividad = new Actividad(
            $_POST["titulo"],
            $_POST["fecha"],
            $_POST["ciudad"],
            $_POST["tipo"],
            $_POST["coste"],
            $_SESSION["usuario"]["Id"],

        );
        if ($nuevaActividad) {
            crearActividad($nuevaActividad);
        } else {
            $error = "Error al crear la actividad";
            echo $error;
        }
    }
}

function crearActividad($actividad)
{
    //definimos a dónde nos vamos a conectar
    $endpoint = "http://localhost/DAES/UF4/ACTIVIDAD/API/index.php";
    $json = json_encode($actividad);
    
    //inicializamos el curl
    $curl = curl_init();
    //le configuramos la url a la que se va a conectar, alojada en la var $endpoint
    curl_setopt($curl, CURLOPT_URL, $endpoint);

    //esta opción chequea que si todo va bien devuelva 1
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //le decimos que le vamos a pasar la info a través del POST
    curl_setopt($curl, CURLOPT_POST, 1);
    //le decimos que los datos van a ser en formato json
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    //le pasamos los datos en json a partir de la encodificación de $actividad
    curl_setopt($curl, CURLOPT_POSTFIELDS, $json);

    //ejecutamos petición
    curl_exec($curl);

    //cerramos la petición
    curl_close($curl);
}

function listarActividades()
{

    //definimos a dónde nos vamos a conectar
    $endpoint = "http://localhost/DAES/UF4/ACTIVIDAD/API/index.php";
    //inicializamos el curl
    $curl = curl_init();

    //le configuramos la url a la que se va a conectar, alojada en la var $endpoint
    curl_setopt($curl, CURLOPT_URL, $endpoint);
    //esta opción chequea que si todo va bien devuelva 1
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //ejecutamos petición y la alojamos en var $output
    $output = curl_exec($curl);
    if (curl_exec($curl) === false) {
        echo 'Curl error: ' . curl_error($curl);
    }
    //cerramos la petición
    curl_close($curl);
    //decodificamos el jason de $output y lo metemos en un array
    $listado = json_decode($output, true);

    $actividades = array();

    foreach ($listado as $fila) {
        $actividad = new Actividad($fila["titulo"], $fila["fecha"], $fila["ciudad"], $fila["tipo"], $fila["coste"], $fila["usuario"]);
        if ($fila["usuario"] == $_SESSION["usuario"]["Id"]) {

            array_push($actividades, $actividad);
        }
    }

    return $actividades;
}



?>

