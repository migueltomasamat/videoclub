<?php

namespace App\Databases;
include_once "BD.php";

use App\Modelos\Cliente;

class ClienteDatabase
{
    public static function staticLoad(int $numero):Cliente{
        $conexion = \app\Databases\BD::crearConexion();
        $query ="SELECT * FROM cliente WHERE numero=?";
        $sentenciaPreparada= $conexion->prepare($query);

        $sentenciaPreparada->bindValue(1,$numero);

        $sentenciaPreparada->execute();

        $resultado= $sentenciaPreparada->fetch(\PDO::FETCH_ASSOC);

        return Cliente::crearClienteFromArray($resultado);
    }

    public static function staticStore(Cliente $cliente){

        $conexion = \app\Databases\BD::crearConexion();
        $query="insert into cliente (nombre,num_soportes_alquilados,max_alquiler_concurrente) values(?,?,?)";
        $sentenciaPreparada = $conexion->prepare($query);

        $sentenciaPreparada->bindValue(1,$cliente->nombre);
        $sentenciaPreparada->bindValue(2,$cliente->getNumSoportesAlquilados());
        $sentenciaPreparada->bindValue(3,$cliente->getMaxAlquilerConcurrente());

        $sentenciaPreparada->execute();

    }

    public static function staticDeleteFromID(int $id){
        $conexion = BD::crearConexion();
        $query = "delete from cliente where numero=:iden";

        $sentenciaPreparada = $conexion->prepare($query);
        $sentenciaPreparada->bindValue('iden',$id);

        $sentenciaPreparada->execute();
    }

    public static function staticDelete(Cliente $cliente){
        self::staticDeleteFromID($cliente->getNumero());
    }
}

