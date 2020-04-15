<?php

class Persona_model extends CI_Model {

    public function getPersonaById($id) {
        return R::load('persona', $id);
    }

    public function getPersonas() {
        return R::findAll('persona');
    }

    public function crearPersona($loginname, $nombre, $pwd, $foto, $altura, $fnac, $pais) {
        
        if ($nombre == null && $pwd == null){
            throw new Exception("Nombre o contraseña nulos");
        }
        
        if (R::findOne('persona', 'loginname=?', [$nombre]) != null) {
            throw new Exception("Nombre de usuario duplicado");
        }
        
        else {
            $persona = R::dispense('persona');
            $persona->nombre = $nombre;
            $persona->pwd = password_hash($pwd, PASSWORD_DEFAULT);
            $persona->foto = $foto;
            $persona->altura = $altura;
            $persona->fnac = $fnac;
            $persona->pais = $pais;
        }
        
        return R::store('persona');
        
    }

    public function registrarPersona($loginname, $nombre, $pwd, $foto, $altura, $fnac, $pais) {
        $ok = ($loginname != null && $nombre != null && $pwd != null && $foto != null && $altura != null && $fnac != null && $pais != null && 
         R::findOne('persona','nombre=?',[$nombre])==null);

        if ($ok) {
            $persona = R::dispense('persona');
            
            $persona->loginname = $loginname;
            $persona->nombre = $nombre;
            $persona->pwd = password_hash($pwd,PASSWORD_DEFAULT);
            $persona->foto = $foto;
            $persona->altura = $altura;
            $persona->fnac = $fnac;
            $persona->pais = $pais;
            
            R::store($persona);
            
        } 
        
        else {
            $e = (R::findOne('persona','nombre=?',[$nombre])!=null? new Exception("Duplicado") : new Exception("valores nulos"));
            throw $e;
        }
    }
    
    public function actualizarPersona($id, $nombre, $idPaisNace) {
        $ok = ($nombre != null && $idPaisNace != null);
        if ($ok) {
            $persona = R::load('persona', $id);
            $persona->nombre = $nombre;
            $persona->nace_id = $idPaisNace;
            
        } 
        
        else {
            $e = ($nombre == null ? new Exception("nulo") : new Exception("duplicado"));
            throw $e;
        }
    }

    public function verificarLogin($nombre, $pwd) {
        
        $usuario = R::findOne('persona','nombre=?',[$nombre]);
        
        if ($usuario == null) {
            throw new Exception("Usuario o contraseña no correctas");
        }
        if (!password_verify($pwd,$usuario->pwd)) {
            
            throw new Exception("Usuario o contraseña no correctas");
        }
        return $usuario;
    }
}

?>
