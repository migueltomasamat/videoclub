<?php
include_once ("Modelos/Soporte.php");
include_once ("Modelos/CintaVideo.php");
include_once ("Modelos/DVD.php");
include_once ("Modelos/Juego.php");
include_once ("Modelos/Cliente.php");
include_once ("Databases/ClienteDatabase.php");

use Modelos\Soporte;
use Modelos\CintaVideo;
use Modelos\DVD;
use Modelos\Juego;
use Modelos\Cliente;
use Databases\ClienteDatabase;

$soporte1 = new Juego("Tenet",22,3,"PS5",1,4);
/*$soporte1->muestraResumen();*/

$cliente1 = new Cliente("Inma",2,2);
Cliente::staticStore($cliente1);
//$clientbd->store($cliente1);

$cliente1->alquilar($soporte1);

$cliente1->listaAlquileres();



