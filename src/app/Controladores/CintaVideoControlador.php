<?php

namespace App\Controladores;

use App\Databases\CintaVideoDatabase;
use App\Modelos\CintaVideo;
use Rakit\Validation\Validation;
use Rakit\Validation\Validator;

class CintaVideoControlador
{
    public function index(){

        echo json_encode(CintaVideoDatabase::mostrarTodos());
    }

    public function show(int $id){
        if (is_integer($id)){
            $cinta = CintaVideoDatabase::mostrarCinta($id);
            if ($cinta===false){
                echo "Cinta de video no encontrada";
            }else{
                echo json_encode($cinta);
            }
        }else{
            echo "El parámetro obtenido no es correcto";
        }
    }

    public function store(){
        $validator = new Validator();

        $datosValidados = $validator->validate($_POST,[
            'titulo'=>'required',
            'numero'=>'required|integer',
            'precio'=>'required|numeric',
            'duracion'=>'required|integer'
        ]);

        if($datosValidados->fails()){
            var_dump($datosValidados->errors());
        }else{
            $cintaVideo = new CintaVideo($_POST['titulo'],$_POST['numero'],$_POST['precio'],$_POST['duracion']);
            CintaVideoDatabase::staticStore($cintaVideo);
        }
    }

    public function update(int $id){
        parse_str(file_get_contents("php://input"),$put_vars);

        var_dump($put_vars, $id);
        $validator = new Validator();

        $datosValidados = $validator->validate($put_vars,[
            'precio'=>'numeric',
            'duracion'=>'integer'
        ]);

        if($datosValidados->fails()){
            var_dump($datosValidados->errors());
        }else{
            $cintaVideo = CintaVideoDatabase::mostrarCinta($id);
            var_dump($cintaVideo);
            if (isset($put_vars['titulo'])){
                $cintaVideo->setTitulo($put_vars['titulo']);
            }
            if (isset($put_vars['precio'])) {
                $cintaVideo->setPrecio($put_vars['precio']);
            }
            if (isset($put_vars['duracion'])) {
                $cintaVideo->setDuracion($put_vars['duracion']);
            }
            CintaVideoDatabase::modificarCinta($cintaVideo);
        }
    }

    public function destroy(int $id){
        if (CintaVideoDatabase::borrarCinta($id)){
            echo "Cinta borrada correctamente";
        }else{
            echo "Error al borrar la cinta";
        }
    }
}