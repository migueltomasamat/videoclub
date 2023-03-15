<?php
include_once ("Modelos/Soporte.php");
include_once ("Modelos/CintaVideo.php");
include_once ("Modelos/DVD.php");
include_once ("Modelos/Juego.php");

use Modelos\Soporte;
use Modelos\CintaVideo;
use Modelos\DVD;
use Modelos\Juego;

$soporte1 = new Juego("Tenet",22,3,"PS5",1,4);
$soporte1->muestraResumen();
