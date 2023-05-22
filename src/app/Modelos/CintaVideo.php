<?php

namespace App\Modelos;

include_once "Soporte.php";

class CintaVideo extends Soporte implements \JsonSerializable
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

    public static function crearCintaFromArray(array $fila):CintaVideo{
        $cintaVideo = new CintaVideo($fila['titulo'],$fila['numero'],$fila['precio'],$fila['duracion']);
        return $cintaVideo;
    }

    public function jsonSerialize(): array
    {
        return [
            "titulo"=>$this->titulo,
            "numero"=>$this->numero,
            "precio"=>$this->getPrecio(),
            "duracion"=>$this->duracion
        ];
    }

    /**
     * @param int $duracion
     */
    public function setDuracion(int $duracion): void
    {
        $this->duracion = $duracion;
    }

}