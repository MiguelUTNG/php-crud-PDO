<?php

class Maestro
{
    private $id;
    private $Nombre;
    private $Apellido;
    private $Telefono;
    private $Materia;

    public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }
}

?>
