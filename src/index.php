<?php
include_once __DIR__."/vendor/autoload.php";
include_once "Router.php";

use App\Controladores\ClienteControlador;
use App\Controladores\CintaVideoControlador;

$router = new Router();

$router->get('/',[VistaIndex::class,'index']);

$router->get("/clientes",[ClienteControlador::class,'index'])
    ->get('/cliente',[ClienteControlador::class,'show'])
    ->post('/cliente',[ClienteControlador::class,'store'])
    ->put('/cliente',[ClienteControlador::class,'update'])
    ->delete('/cliente',[ClienteControlador::class,'destroy']);

$router->get('/cintasvideo',[CintaVideoControlador::class,'index'])
        ->get('/cintavideo',[CintaVideoControlador::class,'show'])
        ->post('/cintavideo',[CintaVideoControlador::class,'store'])
        ->put('/cintavideo',[CintaVideoControlador::class,'update'])
        ->delete('/cintavideo',[CintaVideoControlador::class,'destroy']);






$router->resolver($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);


