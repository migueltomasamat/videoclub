<?php

namespace Modelos;

class Juego extends Soporte
{
    public string $consola;
    private int $minNumJugadores;
    private int $maxNumJugadores;

    public function __construct(string $titulo, int $numero, float $precio, string $consola, int $minNumJugadores, int $maxNumJugadores)
    {
        parent::__construct($titulo, $numero, $precio);
        $this->consola=$consola;
        $this->minNumJugadores=$minNumJugadores;
        $this->maxNumJugadores=$maxNumJugadores;
    }

    public function muestraJugadoresPosibles():void{
        if($this->maxNumJugadores==1){
            echo"<br>Jugadores Posibles: Para un jugador";
        }else{
            if($this->maxNumJugadores==$this->minNumJugadores){
                echo"<br>Jugadores Posibles: Para $this->maxNumJugadores jugadores";
            }else{
                echo"<br>Jugadores Posibles: De $this->minNumJugadores a $this->maxNumJugadores jugadores";
            }
        }
    }
    public function muestraResumen(): void
    {
        parent::muestraResumen();
        echo"<br>Consola:".$this->consola;
        $this->muestraJugadoresPosibles();
    }
}