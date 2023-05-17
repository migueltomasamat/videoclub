<?php
//declare(strict_types=1);

namespace App\Modelos;


class Soporte implements \JsonSerializable
{
    public string $titulo;
    protected int $numero;
    private float $precio;
    const IVA=0.21;

    public function __construct(string $titulo,int $numero,float $precio)
    {
        $this->titulo=$titulo;
        $this->numero=$numero;
        $this->precio=$precio;
    }

    /**
     * @return float
     */
    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function getPrecioConIva(): float
    {
        return $this->precio+($this->precio*self::IVA);
    }

    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }
    public function muestraResumen():void{
        echo"<strong>".$this->titulo."</strong>";
        echo"<br>Precio:".$this->getPrecio()." euros";
        echo"<br>Precio IVA incluido: ".$this->getPrecioConIVA()." euros";

    }
    public function jsonSerialize(): mixed
    {
        return [
          "numero"=>$this->numero,
          "titulo"=>$this->titulo,
          "precio"=>$this->precio
        ];
    }
}