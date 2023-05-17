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
        $cliente = new Cliente($_POST['nombre'],$_POST['numero'],$_POST['maxAlquilerConcurrente']);

        ClienteDatabase::staticStore($cliente);

        echo "Se ha almacenado el cliente correctamente";
    }

    public function index(){
        $clientes=ClienteDatabase::staticLoadAll();
        var_dump($clientes);
        echo json_encode($clientes);
    }

    public function update(int $numcliente){
        parse_str(file_get_contents("php://input"),$put_vars);

        $cliente = ClienteDatabase::modificarCliente($numcliente,$put_vars);

        echo json_encode($cliente);
    }

    public function destroy(int $numCliente){
        ClienteDatabase::staticDeleteFromID($numCliente);
        echo "Cliente Borrado";
    }
}