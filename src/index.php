<?php
include_once ("Modelos/Soporte.php");
include_once ("Modelos/CintaVideo.php");
include_once ("Modelos/DVD.php");

use Modelos\Soporte;
use Modelos\CintaVideo;
use Modelos\DVD;

$soporte1 = new DVD("Tenet",22,3,["español","ingles"],"16/9");
$soporte1->muestraResumen();