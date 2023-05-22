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
    public static function mostrarTodos():?array{
        $conexion = BD::crearConexion();

        $query = "SELECT * FROM cinta_video join soporte on numero=num_soporte";

        $preparedStatement = $conexion->prepare($query);
        $preparedStatement->execute();

        $resultado = $preparedStatement->fetchAll();

        $cintasVideo = [];
        foreach ($resultado as $fila){
            $cintasVideo[]=CintaVideo::crearCintaFromArray($fila);
        }
        return $cintasVideo;
    }

    public static function mostrarCinta(int $id):bool|CintaVideo{
        $conexion = BD::crearConexion();
        $query = "SELECT * FROM cinta_video join soporte on num_soporte=numero where num_soporte=?";

        $preparedStatement = $conexion->prepare($query);

        $preparedStatement->execute([$id]);

        if ($preparedStatement->rowCount()===0){
            return false;
        }else{
            $fila=$preparedStatement->fetch();
            return CintaVideo::crearCintaFromArray($fila);
        }


    }
    public static function borrarCinta(int $id):null|string{
        $conexion = BD::crearConexion();
        $query = "DELETE FROM cinta_video where num_soporte=?";
        $preparedStatement = $conexion->prepare($query);
        $preparedStatement->execute([$id]);
        $query = "DELETE FROM soporte where numero=?";
        $preparedStatement2 = $conexion->prepare($query);
        $preparedStatement2->execute([$id]);

        return $preparedStatement2->errorCode();
    }

    public static function modificarCinta(CintaVideo $cinta){
        $conexion = BD::crearConexion();
        $query = "UPDATE soporte SET titulo=?,precio=? WHERE numero=?";
        $preparedStatement = $conexion->prepare($query);
        $preparedStatement->execute([$cinta->titulo,$cinta->getPrecio(),$cinta->getNumero()]);

        $query = "UPDATE cinta_video SET duracion=? WHERE num_soporte=?";
        $preparedStatement=$conexion->prepare($query);
        $preparedStatement->execute([$cinta->getDuracion(),$cinta->getNumero()]);

    }
}