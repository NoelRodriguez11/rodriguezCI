<?php

class Persona_model extends CI_Model {

    public function getPersonaById($id) {
        return R::load('persona', $id);
    }

    public function getPersonas() {
        return R::findAll('persona');
    }
    
    public function c($loginname, $nombre, $pwd, $ext_foto, $altura, $fnac, $pais)
    {
        if ( $loginname == null || $pwd == null) {
            throw new Exception("Loginname, nombre o password nulos");
        }
        
        if (R::findOne('persona', 'loginname=?', [$loginname]) != null) {
            throw new Exception("Loginname duplicado");
        }
        
        $persona = R::dispense('persona');
        
        $persona->loginname = $loginname;
        $persona->nombre = $nombre;
        $persona->pwd = password_hash($pwd, PASSWORD_BCRYPT);
        $persona->foto = $ext_foto;
        $persona->altura = $altura;
        $persona->fnac = $fnac;
        $persona->pais = $pais;
        
        return R::store($persona);
        
    }

    public function crearPersona($loginname,$pwd) {
        
        if ($loginname == null || $pwd == null){
            throw new Exception("Nombre o contraseña nulos");
        }
        
        if (R::findOne('persona', 'nombre=?', [$loginname]) != null) {
            throw new Exception("nombre duplicado");
        }
        
        $persona = R::dispense('persona');
        
        $persona->loginname = $loginname;
        $persona->pwd = password_hash($pwd, PASSWORD_DEFAULT);
        
        return R::store($persona);
        
    }

    public function registrarPersona($loginname, $nombre, $pwd, $altura, $fnac, $pais, $paisVive) {
        $ok = ($loginname != null && $nombre != null && $pwd != null && $altura != null && $fnac != null && $pais != null && 
         R::findOne('persona','loginname=?',[$loginname])==null);

        if ($ok) {
            $persona = R::dispense('persona');
            
            $persona->loginname = $loginname;
            $persona->nombre = $nombre;
            $persona->pwd = password_hash($pwd,PASSWORD_DEFAULT);
            $persona->altura = $altura;
            $persona->fnac = $fnac;
            $persona->pais = $pais;
            
            R::store($persona);
            
        } 
        
        else {
            $e = (R::findOne('persona','loginname=?',[$loginname])!=null? new Exception("Duplicado") : new Exception("valores nulos"));
            throw $e;
        }
    }
    
    public function actualizarPersona($id, $nombre, $pais) {
        $ok = ($nombre != null && $pais != null);
        if ($ok) {
            $persona = R::load('persona', $id);
            $persona->nombre = $nombre;
            $persona->pais = $pais;
            
        } 
        
        else {
            $e = ($nombre == null ? new Exception("nulo") : new Exception("duplicado"));
            throw $e;
        }
    }

    public function verificarLogin($loginname, $pwd) {
        
        $usuario = R::findOne('persona','loginname=?',[$loginname]);
        
        if ($usuario == null) {
            throw new Exception("Usuario o contraseña no correctas");
        }
        if (!password_verify($pwd,$usuario->pwd)) {
            
            throw new Exception("Usuario o contraseña no correctas");
        }
        return $usuario;
    }
    public function borrarPersona($id) {
        R::trash(R::load('persona',$id));
    }
}

?>
