<?php

namespace App\Controladores;

use App\Databases\ClienteDatabase;
use App\Modelos\Cliente;
use App\Modelos\DVD;
use Ramsey\Uuid\Uuid;

class ClienteControlador
{
    public function __construct()
    {
    }

    public function show(string $numeroCliente){

        //Llamar al modelo y conseguir del cliente
        $cliente=ClienteDatabase::staticLoad($numeroCliente);
        //Convertir los datos JSON
        $cliente_json = json_encode($cliente);

        echo $cliente_json;
        //Llamar a una vista que nos muestre los datos del cliente
        //ClienteVista::mostrarDatosCliente($cliente_json);
    }

    public function load (string $numeroCliente){
        $cliente=ClienteDatabase::staticLoad($numeroCliente);
        $cliente->alquilar(new DVD('Batman',1548,2.4,'es-en','16:9'));
        ClienteDatabase::staticStore($cliente);
    }

    public function store(){
        if (isset($_POST['maxAlquilerConcurrente'])){
            $cliente = new Cliente($_POST['nombre'],$_POST['numero'],$_POST['maxAlquilerConcurrente']);
        }else{
            $cliente = new Cliente($_POST['nombre'],$_POST['numero']);
        }

        ClienteDatabase::staticStore($cliente);

        echo "Se ha almacenado el cliente correctamente";
    }

    public function index(){
        $clientes=ClienteDatabase::staticLoadAll();
        var_dump($clientes);
        echo json_encode($clientes);
    }

    public function update(string $numcliente){
        parse_str(file_get_contents("php://input"),$put_vars);

        $cliente = ClienteDatabase::modificarCliente($numcliente,$put_vars);

        echo json_encode($cliente);
    }

    public function destroy(string $numCliente){
        ClienteDatabase::staticDeleteFromID($numCliente);
        echo "Cliente Borrado";
    }

    public function showAll(){
        $clientes = ClienteDatabase::staticLoadAll();
        require __DIR__.'/../Vista/clientes.vista.php';
    }

    public function showCliente(string $idCliente){
        $cliente = ClienteDatabase::staticLoad($idCliente);
        require __DIR__.'/../Vista/cliente.vista.php';
    }

    public function insertarCliente(){
        $idUsuario= Uuid::uuid4()->toString();
        require __DIR__.'/../Vista/insertar.cliente.vista.php';
    }
}