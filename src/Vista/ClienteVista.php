<?php

namespace Vista;

use Modelos\Cliente;

class ClienteVista
{
    public static function listaAlquileres(Cliente $cliente):void{

        echo "El cliente $cliente->nombre tiene $cliente->getNumSoportesAlquilados()<br>";
        foreach ($cliente->getSoportesAlquilados() as $soporte){
            $soporte->muestraResumen();
        }
    }
}