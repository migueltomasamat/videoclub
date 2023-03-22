<?php

namespace Modelos;

include_once "Soporte.php";

use Modelos\Soporte;

class CintaVideo extends Soporte
{
    private int $duracion;

    public function __construct(string $titulo, int $numero, float $precio, int $duracion)
    {
        parent::__construct($titulo, $numero, $precio);
        $this->duracion=$duracion;
    }
    public function muestraResumen(): void
    {
        parent::muestraResumen();
        echo"<br>Duración:".$this->duracion." minutos";
    }
}