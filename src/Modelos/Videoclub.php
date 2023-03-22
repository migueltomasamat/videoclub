<?php

namespace Modelos;

class Videoclub
{
    private string $nombre;
    private array $productos=[];
    private int $numProductos;
    private array $socios = [];
    private int $numSocios;

    public function __construct(string $nombre){
        $this->nombre=$nombre;
        $this->numProductos=0;
        $this->numSocios=0;
    }

    private function incluirProducto(Soporte $soporte):Videoclub|bool{
        $retorno=false;
        $this->productos[]=$soporte;
        $this->numProductos++;
        $retorno=$this;
        return $retorno;
    }
    public function incluirCintaVideo(string $titulo,float $precio, int $duracion):Videoclub|bool{
        $retorno=false;
        $cintaVideo = new CintaVideo($titulo,$this->numProductos++,$precio,$duracion);
        $this->incluirProducto($cintaVideo);

        $retorno=$this;
        return $retorno;
    }
    public function incluirDvd(string $titulo, float $precio, string $idiomas, string $pantalla):Videoclub|bool{
        $retorno=false;
        $dvd = new DVD($titulo,$this->numProductos++,$precio,$idiomas,$pantalla);
        $this->incluirProducto($dvd);

        $retorno=$this;
        return $retorno;
    }
    public function incluirJuego(string $titulo, float $precio,string $consola,int $minJ, int $maxJ):Videoclub|bool{
        $retorno=false;
        $juego = new Juego($titulo,$this->numProductos++,$precio,$consola,$minJ,$maxJ);
        $this->incluirProducto($juego);

        $retorno=$this;
        return $retorno;
    }
    public function incluirSocio(string $nombre, int $maxAlquileresConcurrentes=3):Videoclub|bool{
        $retorno=false;
        $socio = new Cliente($nombre,$this->numSocios+1,$maxAlquileresConcurrentes);
        $this->socios[]=$socio;
        $this->numSocios++;

        $retorno=$this;
        return $retorno;
    }
    public function listarProductos(){
        foreach ($this->productos as $producto){
            $producto->muestraResumen();
        }

    }
    public function listarSocios(){
        foreach ($this->socios as $socio){
            $socio->muestraResumen();
        }

    }
    public function alquilarSocioProducto(int $numCliente, int $numSoporte):bool{
        if(!$socio=$this->encontrarCliente($numCliente)){
            echo "Socio no encontrado";
            return false;
        }else{
            if(!$producto=$this->encontrarSoporte($numSoporte)){
                echo "Producto no encontrado";
                return false;
            }
        }

        $socio->alquilar($producto);
        return true;
    }

    private function encontrarCliente(int $numCliente):Cliente|bool{
        foreach ($this->socios as $socio){
            if($socio.getNumero()==$numCliente){
                return $socio;
            }
        }
        return false;

    }

    private function encontrarSoporte(int $numSoporte):Soporte{
        foreach ($this->productos as $producto){
            if($producto.getNumero()==$numSoporte){
                return $producto;
            }
        }
        return false;
    }

}