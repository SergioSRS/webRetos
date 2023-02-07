<?php
class Reto
{
    // Campos de la tabla
    public $id;
    public $nombre;
    public $dirigido;
    public $descripcion;
    public $fechaFinInscripcion;
    public $fechaInicioInscripcion;
    public $fechaFinReto;
    public $fechaInicioReto;
    public $fechaPublicacion;
    public $publicado;


    function __construct()
    {
        $id=0;
        $nombre="";
        $dirigido="";
        $descripcion="";
        $fechaFinInscripcion="";
        $fechaInicioInscripcion="";
        $fechaFinReto="";
        $fechaInicioReto="";
        $fechaPublicacion="";
        $publicado=false;

    }
}