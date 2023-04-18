<?php
include_once __DIR__."/vendor/autoload.php";
include_once "Router.php";

use App\Controladores\ClienteControlador;

$router = new Router();

$router->get("/clientes",[ClienteControlador::class,'index'])
    ->get('/cliente',[ClienteControlador::class,'show']);

$router->resolver($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);


