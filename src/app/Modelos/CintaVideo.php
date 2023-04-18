<?php

namespace App\Modelos;

include_once "Soporte.php";

class CintaVideo extends Soporte
{
    private int $duracion;

    public function __construct(string $titulo, int $numero, float $precio, int $duracion)
    {
        parent::__construct($titulo, $numero, $precio);
        $this->duracion=$duracion;
    }

    /**
     * @return int
     */
    public function getDuracion(): int
    {
        return $this->duracion;
    }

    public function muestraResumen(): void
    {
        parent::muestraResumen();
        echo"<br>Duración:".$this->duracion." minutos";
    }
}