<?php


namespace Modelos;
require_once __DIR__."/../Conexion.php";
use PDO;

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

    public function store(Cliente $cliente){

        $conexion=self::crearConexion();
        almacenar($cliente,$conexion);

    }
    public static function staticStore(Cliente $cliente){

        $conexion=self::crearConexion();
        almacenar($cliente,$conexion);

    }

    private function almacenar(Cliente $cliente, PDO $conexion){
        $query="insert into cliente (nombre,num_soportes_alquilados,max_alquiler_concurrente) values(?,?,?)";
        $sentenciaPreparada = $conexion->prepare($query);

        $sentenciaPreparada->bindValue(1,$cliente->nombre);
        $sentenciaPreparada->bindValue(2,$cliente->getNumSoportesAlquilados());
        $sentenciaPreparada->bindValue(3,$cliente->getMaxAlquilerConcurrente());

        $sentenciaPreparada->execute();
    }
    public static function crearConexion():PDO{
        try {
            $conexion = new PDO('mysql:dbname='.BASEDATOS.';host='.SERVIDOR, USUARIO, PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
        return $conexion;
    }







}