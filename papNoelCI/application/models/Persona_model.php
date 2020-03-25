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

    public function crearPersona($nombre, $pwd, $idPaisNace, $idPaisReside, $idsAficionGusta, $idsAficionOdia)
    {
        $ok = ($nombre != null && $idPaisNace != null && $idPaisReside != null);
        if ($ok) {
            $persona = R::dispense('persona');
            
            $paisNacimiento = R::load('pais', $idPaisNace);
            $paisResidencia = R::load('pais', $idPaisReside);
            
            $persona->nombre = $nombre;
            $persona->pwd = password_hash($pwd,PASSWORD_DEFAULT);
            $persona->nace = $paisNacimiento;
            $persona->reside = $paisResidencia;

            R::store($persona);

            foreach ($idsAficionGusta as $idAficionGusta) {
                $aficion = R::load('aficion', $idAficionGusta);
                $gusta = R::dispense('gusta');
                $gusta->persona = $persona;
                $gusta->aficion = $aficion;
                R::store($gusta);
            }
            foreach ($idsAficionOdia as $idAficionOdia) {
                $aficion = R::load('aficion', $idAficionOdia);
                $odia = R::dispense('odia');
                $odia->persona = $persona;
                $odia->aficion = $aficion;
                R::store($odia);
            }
        } else {
            $e = ($nombre == null ? new Exception("nulo") : new Exception("duplicado"));
            throw $e;
        }
    }

    public function registrarPersona($nombre, $pwd, $idPaisReside) {
        $ok = ($nombre != null && $idPaisReside != null && 
            R::findOne('persona','nombre=?',[$nombre])==null);

        if ($ok) {
            $persona = R::dispense('persona');
            
            $paisResidencia = R::load('pais', $idPaisReside);
            
            $persona->nombre = $nombre;
            $persona->pwd = password_hash($pwd,PASSWORD_DEFAULT);
            $persona->reside = $paisResidencia;
            
            R::store($persona);
            
        } else {
            $e = (R::findOne('persona','nombre=?',[$nombre])!=null? new Exception("Duplicado") : new Exception("valores nulos"));
            throw $e;
        }
    }
    public function actualizarPersona($id, $nombre, $idPaisNace, $idPaisReside, $idsAficionGusta, $idsAficionOdia)
    {
        $ok = ($nombre != null && $idPaisNace != null && $idPaisReside != null);
        if ($ok) {
            $persona = R::load('persona', $id);
            $persona->nombre = $nombre;
            $persona->nace_id = $idPaisNace;
            $persona->reside_id = $idPaisReside;

            $comunes = [];
            foreach ($persona->ownGustaList as $gusta) {
                if (! in_array($gusta->aficion_id, $idsAficionGusta)) {
                    R::store($persona);
                    R::trash($gusta);
                } else {
                    $comunes[] = $gusta->aficion_id;
                }
            }

            foreach (array_diff($idsAficionGusta, $comunes) as $idGusta) {
                $aficion = R::load('aficion', $idGusta);
                $gusta = R::dispense('gusta');
                $gusta->persona = $persona;
                $gusta->aficion = $aficion;
                R::store($persona);
                R::store($gusta);
            }
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
