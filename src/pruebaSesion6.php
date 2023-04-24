<?php
include_once __DIR__."/vendor/autoload.php";
use App\Databases\SoporteDatabase;

//almacenado de cinta de video
$soporte = new \App\Modelos\CintaVideo('Avatar3',42,2.5,200);
\App\Databases\CintaVideoDatabase::staticStore($soporte);

//Almacenado de soporte
$soporte2 = new \App\Modelos\CintaVideo('Taxi',43,2.5,200);
SoporteDatabase::almacenarSoporte($soporte2);

//Asignación de un soporte a un cliente
$cliente = \App\Databases\ClienteDatabase::staticLoad(7);
\App\Databases\SoporteDatabase::alquilarSoporte($soporte2,$cliente);

//Modificacion de un cliente
$cliente2 = \App\Databases\ClienteDatabase::staticLoad(2);
$cliente2->alquilar($soporte);
$cliente2->alquilar($soporte2);
echo $cliente2->getNumSoportesAlquilados();
\App\Databases\ClienteDatabase::editarCliente($cliente2);
