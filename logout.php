<?php

session_start(); //siempre inoiciamos la sesión, para luego poder destruirla
session_destroy();

unset($_COOKIE['cookie_usuario']);
setcookie('cookie_usuario', $nombre_usuario, time()-3600,'/');

header("Location: index.php");//tras cerrar sesión, esta función nos lleva a la página principal
exit();

?>