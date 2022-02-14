<?php


$conexion_mysql = mysqli_connect("localhost", "root", "", "ifpdb");

if ($conexion_mysql->connect_errno) {
    printf("Error de conexión a la base de datos: %s\n", $conexion_mysql->connect_error);
    exit();
}
/*
//función para comprobar que la conexión funciona correctamente 
function ejecutarCosulta($consulta)
{
    global $conexion_mysql;
    
    $resultado = mysqli_query($conexion_mysql,$consulta);
    
    if(!$resultado){
        printf("Error: %s\n", $conexion_mysql->error);        
    }

    return $resultado;
}
*/
