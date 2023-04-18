<?php

namespace App\Databases;
require_once __DIR__."/../../Conexion.php";

use Modelos\PDOException;
use PDO;

class BD
{
    public static function crearConexion():PDO{
        $conexion=null;
        try {
            $conexion = new PDO('mysql:dbname='.BASEDATOS.';host='.SERVIDOR, USUARIO, PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
        return $conexion;
    }
}