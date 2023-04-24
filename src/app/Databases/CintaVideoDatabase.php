<?php

namespace App\Databases;
include_once "BD.php";

use App\Modelos\CintaVideo;
use App\Modelos\Soporte;

class CintaVideoDatabase
{
    public static function staticStore(CintaVideo $cinta){

        $conexion = \app\Databases\BD::crearConexion();
        //Crear el soporte
        SoporteDatabase::almacenarSoporte($cinta);

        //Almacenaré la cinta de video
        $query="insert into cinta_video (num_soporte,duracion) values(?,?)";
        $sentenciaPreparada = $conexion->prepare($query);

        $sentenciaPreparada->bindValue(1,$cinta->getNumero());
        $sentenciaPreparada->bindValue(2,$cinta->getDuracion());

        $sentenciaPreparada->execute();

    }
}