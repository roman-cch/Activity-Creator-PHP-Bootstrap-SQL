<?php

class Actividad{

    public $titulo;
    public $fecha;
    public $ciudad;
    public $tipo;
    public $coste;
    public $usuario;

    function __construct($titulo, $fecha, $ciudad, $tipo, $coste, $usuario)
    {
        $this->titulo = $titulo;
        $this->fecha = $fecha;
        $this->ciudad = $ciudad;
        $this->tipo = $tipo;
        $this->coste = $coste;
        $this->usuario = $usuario;
    }

}

?>