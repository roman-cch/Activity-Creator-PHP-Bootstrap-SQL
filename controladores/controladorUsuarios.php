<?php

require "db.php"; 


//comprobar si el usuario existe, si la sesión está activada, y si no, enviar al usuario al login.php
function comprobarLogin()
{
    if (
        !isset($_SESSION["usuario"]) &&
        isset($_COOKIE["cookie_usuario"])
    ) {
        $_SESSION["usuario"] = $_COOKIE["cookie_usuario"];
    }

    if (!isset($_SESSION["usuario"])) //si al arrancar la sesión no se ha asignado la variable de $_SESSION "usuario" no se podrá hacer login
    {
        header("Location: login.php");
        exit();
    }
}

function obtenerUsuario($nombreUsuario, $contraseña)
{
    global $conexion_mysql;

    $consulta = "SELECT Id, Nombre, Correo
                 FROM usuarios
                 WHERE Nombre = ? AND Contraseña = ?";

    $stmt = $conexion_mysql->prepare($consulta);
    $stmt->bind_param('ss',$nombreUsuario, $contraseña);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado) {

        $usuario_db = mysqli_fetch_assoc($resultado);
        return $usuario_db; 
    }
}

function hacerLogin($usuario)
{
    //si las credenciales son correctas le asignamos un valor a la sesion de usuario que nos llegó de la base de datos
    $id_usuario = $usuario["Id"];
    $_SESSION["usuario"] = $usuario;
    //guardamos en la cookie el id del usuario
    setcookie("cookie_usuario", $id_usuario, time() + 3600, '/');

    header("Location: index.php");
    exit();
}

function crearUsuario($id,$correo,$nombre,$contraseña)
{
    global $conexion_mysql;

    $consulta = "INSERT INTO usuarios (Id, Correo, Nombre, Contraseña) 
    VALUES (?,?,?,?)";

    $stmt = $conexion_mysql->prepare($consulta);
    $stmt->bind_param('ssss',$id,$correo,$nombre,$contraseña);
    $stmt->execute();
    $resultado = $stmt->execute();
    
    if ($resultado) {

        return obtenerUsuario($id,$contraseña); 
    }
}
