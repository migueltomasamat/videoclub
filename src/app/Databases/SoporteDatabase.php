<?php

namespace App\Databases;
include_once "BD.php";
use App\Databases\BD;
use App\Modelos\Soporte;
use App\Modelos\Cliente;

class SoporteDatabase
{
    public static function almacenarSoporte(Soporte $soporte){
        $conexion=\App\Databases\BD::crearConexion();

        $query = "insert into soporte (numero,titulo,precio) values (:numero,:titulo,:precio)";
        $sentenciaPreparada = $conexion->prepare($query);

        $sentenciaPreparada->bindValue('numero',$soporte->getNumero());
        $sentenciaPreparada->bindValue('titulo',$soporte->titulo);
        $sentenciaPreparada->bindValue('precio',$soporte->getPrecio());

        $sentenciaPreparada->execute();
    }

    public static function alquilarSoporte(Soporte $soporte, Cliente $cliente){
        $conexion = BD::crearConexion();
        $query = "update soporte set num_cliente=? where numero=?";

        $sentenciaPreparada = $conexion->prepare($query);

        $sentenciaPreparada->execute([$cliente->getNumero(),$soporte->getNumero()]);

    }

}