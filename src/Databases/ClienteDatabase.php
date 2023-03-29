<?php

namespace Databases;
require_once __DIR__."/../Conexion.php";
use PDO;
use Modelos\Cliente;
class ClienteDatabase
{
    private PDO $conexion;
   public function __construct()
   {
       try {
           $this->conexion = new PDO('mysql:dbname='.BASEDATOS.';host='.SERVIDOR, USUARIO, PASSWORD);
           $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           echo "Se ha conectado";
       } catch (PDOException $e) {
           echo 'Falló la conexión: ' . $e->getMessage();
       }
   }
    public function store(Cliente $cliente){

       $query="insert into cliente (nombre,num_soportes_alquilados,max_alquiler_concurrente) values(?,?,?)";
        $sentenciaPreparada = $this->conexion->prepare($query);

        $sentenciaPreparada->bindValue(1,$cliente->nombre);
        $sentenciaPreparada->bindValue(2,$cliente->getNumSoportesAlquilados());
        $sentenciaPreparada->bindValue(3,$cliente->getMaxAlquilerConcurrente());

        $sentenciaPreparada->execute();

    }

    public static function staticStore(Cliente $cliente){
        $conexion=self::crearConexion();
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

