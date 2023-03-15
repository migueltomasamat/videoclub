<?php

namespace Modelos;

class DVD extends Soporte
{
    public array $idiomas;
    private string $formatoPantalla;

    public function __construct(string $titulo, int $numero, float $precio,array $idiomas,string $formatoPantalla)
    {
        parent::__construct($titulo, $numero, $precio);
        $this->idiomas=$idiomas;
        $this->formatoPantalla=$formatoPantalla;
    }

    public function muestraResumen(): void
    {
        parent::muestraResumen();
        echo "<br>Idiomas: ";
            foreach ($this->idiomas as $idioma){
                echo $idioma."|";
            }
        echo"<br>Formato Pantalla:".$this->formatoPantalla;

    }

}