<?php

class Router
{
    private array $rutas = [];

    public function get(string $ruta,array $accion):Router{
        $this->rutas['GET'][$ruta]=$accion;
        return $this;
    }
    public function post(string $ruta,array $accion):Router{
        $this->rutas['POST'][$ruta]=$accion;
        return $this;
    }
    public function put(string $ruta,array $accion):Router{
        $this->rutas['PUT'][$ruta]=$accion;
        return $this;
    }
    public function patch(string $ruta,array $accion):Router{
        $this->rutas['PATCH'][$ruta]=$accion;
        return $this;
    }
    public function delete(string $ruta,array $accion):Router{
        $this->rutas['DELETE'][$ruta]=$accion;
        return $this;
    }

    public function resolver(string $requestURI,string $requestMethod){
        $path = parse_url($requestURI)['path'];

        $pathExpandido = explode('/',$path);
        $argumentos=null;
        if (count($pathExpandido)>2){
            $argumentos = $pathExpandido[2];
            $path = '/'.$pathExpandido[1];
        }

        $claseMetodoALlamar=$this->rutas[$requestMethod][$path];

        $claseALlamar = $claseMetodoALlamar[0];
        $metodoALlamar = $claseMetodoALlamar[1];

        $controlador = new $claseALlamar();
        return call_user_func_array([$controlador,$metodoALlamar],[$argumentos]);
    }


}