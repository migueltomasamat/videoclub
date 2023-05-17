<?php

namespace App\Databases;
include_once "BD.php";

use App\Modelos\Cliente;
use App\Modelos\Soporte;

class ClienteDatabase
{
    const JSON_ENCODE = 1;
    const CLIENTE_ENCODE = 0;

    public static function staticLoadAll():array{
        $conexion = BD::crearConexion();
        $query = "SELECT * FROM cliente";
        $sentenciaPreparada = $conexion->prepare($query);
        $sentenciaPreparada->execute();

        $resultado = $sentenciaPreparada->fetchAll();
        $arrayClientes = null;
        foreach ($resultado as $fila_cliente){
            $cliente=Cliente::convertirFilaACliente($fila_cliente);
            $soportes = self::obtenerSoportesCliente($cliente->getNumero());
            if ($soportes){
                $cliente->setSoportesAlquilados($soportes);
            }

            $arrayClientes[]=$cliente;
        }
        return $arrayClientes;
    }
    public static function staticLoad(int $numero):Cliente{
        $conexion = \app\Databases\BD::crearConexion();
        $query ="SELECT * FROM cliente WHERE numero=?";
        $sentenciaPreparada= $conexion->prepare($query);

        $sentenciaPreparada->bindValue(1,$numero);

        $sentenciaPreparada->execute();

        $resultado= $sentenciaPreparada->fetch(\PDO::FETCH_ASSOC);

        $cliente = Cliente::crearClienteFromArray($resultado);

        $soportes = self::obtenerSoportesCliente($cliente->getNumero());
        if ($soportes){
            $cliente->setSoportesAlquilados($soportes);
        }
        return $cliente;
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

    public static function editarCliente(Cliente $cliente){
        $conexion = BD::crearConexion();
        $sentenciaPreparada = $conexion->prepare
        ("update cliente set nombre=:nombre,num_soportes_alquilados=:numSoportes,max_alquiler_concurrente=:maxAlquiler where numero=:numCliente");

        $sentenciaPreparada->bindValue('nombre',$cliente->nombre);
        $sentenciaPreparada->bindValue('numSoportes',$cliente->getNumSoportesAlquilados());
        $sentenciaPreparada->bindValue('maxAlquiler',$cliente->getMaxAlquilerConcurrente());
        $sentenciaPreparada->bindValue('numCliente',$cliente->getNumero());

        $sentenciaPreparada->execute();

        //Almacenamiento de los alquileres
        foreach ($cliente->getSoportesAlquilados() as $alquilado){
            SoporteDatabase::alquilarSoporte($alquilado,$cliente);
        }
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

    public static function obtenerNumSoportesCliente(int $id):int{
        $conexion = BD::crearConexion();
        $query = "SELECT count(*) as 'num_soportes' from soporte where num_cliente=?";
        $sentenciaPreparada = $conexion->prepare($query);
        $sentenciaPreparada->bindValue(1,$id);

        $sentenciaPreparada->execute();
        $result = $sentenciaPreparada->fetch();

        return $result['num_soportes'];
    }

    public static function obtenerSoportesCliente (int $id):array|null{
        $conexion = BD::crearConexion();
        $query="select * from soporte where num_cliente=:id_cliente";
        $sentenciaPreparada = $conexion->prepare($query);

        $sentenciaPreparada->bindValue("id_cliente",$id);
        $sentenciaPreparada->execute();
        $resultado = $sentenciaPreparada->fetchAll();
        $arraySoportes = null;
        foreach ($resultado as $fila){
            $arraySoportes[]=new Soporte($fila['titulo'],$fila['numero'],$fila['precio']);
        }
        return $arraySoportes;

    }

    public static function modificarCliente(int $id, array $datosCliente):?Cliente{
        $cliente =false;
        $conexion = BD::crearConexion();
        $sentenciaPreparada= null;
        if (isset($datosCliente['nombre']) && isset($datosCliente['maxAlquilerConcurrente'])){
            $query = "update cliente set nombre=:nom_cliente, max_alquiler_concurrente=:max_alquiler where numero=:num_cliente";
            $sentenciaPreparada=$conexion->prepare($query);
            $sentenciaPreparada->bindValue("nom_cliente",$datosCliente['nombre']);
            $sentenciaPreparada->bindValue("max_alquiler",$datosCliente['maxAlquilerConcurrente']);
        }elseif (isset($datosCliente['nombre'])){
            $query = "update cliente set nombre=:nom_cliente where numero=:num_cliente";
            $sentenciaPreparada=$conexion->prepare($query);
            $sentenciaPreparada->bindValue("nom_cliente",$datosCliente['nombre']);
        }else{
            $query = "update cliente set max_alquiler_concurrente=:max_alaquiler where numero=:num_cliente";
            $sentenciaPreparada=$conexion->prepare($query);
            $sentenciaPreparada->bindValue("max_alquiler",$datosCliente['maxAlquilerConcurrente']);
        }
        $sentenciaPreparada->bindValue("num_cliente",$id);
        $sentenciaPreparada->execute();

        $cliente = ClienteDatabase::staticLoad($id);
        return $cliente;

    }
}

