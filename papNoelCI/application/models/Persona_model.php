<?php

class Persona_model extends CI_Model
{

    public function getPersonaById($id)
    {
        return R::load('persona', $id);
    }

    public function getPersonas()
    {
        return R::findAll('persona');
    }

    public function crearPersona($nombre, $pwd, $idPaisNace)
    {
        $ok = ($nombre != null && $idPaisNace != null);
        if ($ok) {
            $persona = R::dispense('persona');
            
            $paisNacimiento = R::load('pais', $idPaisNace);
            
            $persona->nombre = $nombre;
            $persona->pwd = password_hash($pwd,PASSWORD_DEFAULT);
            $persona->nace = $paisNacimiento;

            R::store($persona);

        } else {
            $e = ($nombre == null ? new Exception("nulo") : new Exception("duplicado"));
            throw $e;
        }
    }

    public function registrarPersona($nombre, $pwd, $idPaisNace) {
        $ok = ($nombre != null && $idPaisNace != null && 
            R::findOne('persona','nombre=?',[$nombre])==null);

        if ($ok) {
            $persona = R::dispense('persona');
            
            $paisNacimiento = R::load('pais', $idPaisNace);
            
            $persona->nombre = $nombre;
            $persona->pwd = password_hash($pwd,PASSWORD_DEFAULT);
            
            R::store($persona);
            
        } else {
            $e = (R::findOne('persona','nombre=?',[$nombre])!=null? new Exception("Duplicado") : new Exception("valores nulos"));
            throw $e;
        }
    }
    public function actualizarPersona($id, $nombre, $idPaisNace)
    {
        $ok = ($nombre != null && $idPaisNace != null);
        if ($ok) {
            $persona = R::load('persona', $id);
            $persona->nombre = $nombre;
            $persona->nace_id = $idPaisNace;
            
        } else {
            $e = ($nombre == null ? new Exception("nulo") : new Exception("duplicado"));
            throw $e;
        }
    }

    public function verificarLogin($nombre,$pwd) {
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
