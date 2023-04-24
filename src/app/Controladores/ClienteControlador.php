<?php

namespace App\Controladores;

use App\Databases\ClienteDatabase;
use App\Modelos\Cliente;
use App\Modelos\DVD;
use App\Vista\ClienteVista;

class ClienteControlador
{
    public function __construct()
    {
    }

    public function show(int $numeroCliente){

        //Llamar al modelo y conseguir del cliente
        $cliente=ClienteDatabase::staticLoad($numeroCliente);
        //Convertir los datos JSON
        $cliente_json = json_encode($cliente);

        //Llamar a una vista que nos muestre los datos del cliente
        ClienteVista::mostrarDatosCliente($cliente_json);
    }

    public function load (int $numeroCliente){
        $cliente=ClienteDatabase::staticLoad($numeroCliente);
        $cliente->alquilar(new DVD('Batman',1548,2.4,'es-en','16:9'));
        ClienteDatabase::staticStore($cliente);
    }

    public function store(){
        $cliente=new Cliente('Alba',4,3);
        ClienteDatabase::staticStore($cliente);
    }

    public function index(){
        echo "He entrado en el método índex";
    }
}