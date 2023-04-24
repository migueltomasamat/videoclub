<?php


namespace App\Modelos;

use app\Databases\ClienteDatabase;
use App\Databases\SoporteDatabase;
use BD;

class Cliente
{
    public string $nombre;
    private int $numero;
    private array $soportesAlquilados=[];
    private int $numSoportesAlquilados;
    private int $maxAlquilerConcurrente;

    public function __construct(string $nombre, int $numero, int $maxAlquilerConcurrente=3){
        $this->nombre=$nombre;
        $this->numero=$numero;
        $this->maxAlquilerConcurrente=$maxAlquilerConcurrente;
        $this->numSoportesAlquilados=0;
    }

    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * @param int $numero
     */
    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    /**
     * @return int
     */
    public function getNumSoportesAlquilados(): int
    {
        return $this->numSoportesAlquilados;
    }

    public function muestraResumen()
    {
        echo "Nombre: $this->nombre <br>";
        echo "Soportes Alquilados: ". count($this->soportesAlquilados);
    }

    /**
     * @return array
     */
    public function getSoportesAlquilados(): array
    {
        return $this->soportesAlquilados;
    }



    public function tieneAlquilado(Soporte $soporte):bool{
        $retorno=false;
        foreach ($this->soportesAlquilados as $soporteAlquilado){
            if($soporteAlquilado==$soporte){
                $retorno=true;
            }
        }
        return $retorno;
    }
    public function alquilar(Soporte $soporte):bool{
        $retorno=false;
        if($this->numSoportesAlquilados < $this->maxAlquilerConcurrente){
            //Se procede a alquilar el soporte
            if($this->tieneAlquilado($soporte)){
                echo "Ya tienes alquilado este soporte";
            }else{
                $this->soportesAlquilados[]=$soporte;
                /*SoporteDatabase::alquilarSoporte($soporte,$this);*/
                $this->numSoportesAlquilados++;
                $retorno=true;
            }
        }else{
            echo "Se ha alcanzado el número máximo de soportes alquilados";
        }
        return $retorno;
    }
    public function devolver(int $numSoporte):bool{
        $retorno=false;

        //Comprobar que el soporte esté alquilado
        foreach ($this->soportesAlquilados as $soporteAlquilado){
            if ($soporteAlquilado->getNumero()==$numSoporte){
                unset($this->soportesAlquilados[$soporteAlquilado]);
                $retorno=true;
            }
        }

        if($retorno!=false){
            echo "No se ha encontrado el soporte a devolver";
        }else{
            $this->numSoportesAlquilados--;
        }
        return $retorno;


    }

    /**
     * @return int
     */
    public function getMaxAlquilerConcurrente(): int
    {
        return $this->maxAlquilerConcurrente;
    }

    public static function crearClienteFromArray(array $array):Cliente{

        $cliente = new Cliente($array["nombre"],$array['numero'],$array['max_alquiler_concurrente']);

        $cliente->setNumSoportesAlquilados($array['num_soportes_alquilados']);

        return $cliente;

    }

    /**
     * @param array $soportesAlquilados
     */
    public function setSoportesAlquilados(array $soportesAlquilados): void
    {
        $this->soportesAlquilados = $soportesAlquilados;
    }

    /**
     * @param int $numSoportesAlquilados
     */
    public function setNumSoportesAlquilados(int $numSoportesAlquilados): void
    {
        $this->numSoportesAlquilados = $numSoportesAlquilados;
    }

    /**
     * @param int $maxAlquilerConcurrente
     */
    public function setMaxAlquilerConcurrente(int $maxAlquilerConcurrente): void
    {
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }

    public function __serialize(): array
    {
        return [
            "nombre"=>$this->nombre,
            "numero"=>$this->numero,
            "numSoportesAlquilados"=>$this->numSoportesAlquilados,
            "maxAlquilerConcurrente"=>$this->maxAlquilerConcurrente
        ];
    }

    /* Funciones relacionadas con el almacenamiento de BD */
    public function almacenar():void{
        ClienteDatabase::staticStore($this);
    }

    public function borrar():void{
        ClienteDatabase::staticDelete($this);
    }
}