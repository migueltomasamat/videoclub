<?php

namespace App\Databases;
include_once "BD.php";

use App\Modelos\CintaVideo;

class CintaVideoDatabase
{
    public static function staticStore(CintaVideo $cinta){

        $conexion = \app\Databases\BD::crearConexion();
        $query="insert into cinta_video (numero,titulo,precio,duracion) values(?,?,?,?)";
        $sentenciaPreparada = $conexion->prepare($query);

        $sentenciaPreparada->bindValue(1,$cinta->getNumero());
        $sentenciaPreparada->bindValue(2,$cinta->titulo);
        $sentenciaPreparada->bindValue(3,$cinta->getPrecio());
        $sentenciaPreparada->bindValue(4,$cinta->getDuracion());

        $sentenciaPreparada->execute();

    }
}