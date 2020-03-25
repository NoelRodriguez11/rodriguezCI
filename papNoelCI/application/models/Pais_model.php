<?php

class Pais_model extends CI_Model
{
    public function borrarPais($id) {
        R::trash(R::load('pais',$id));
    }

    public function getPaises()
    {
        return R::findAll('pais');
    }

    public function crearPais($nombre)
    {
        $pais = R::findOne('pais','nombre=?',[$nombre]);
        $ok = ($pais==null && $nombre!=null);
        if ($ok) {
            $pais = R::dispense('pais');
            $pais->nombre = $nombre;
            $pais->alias('nace')->xownPersonaList = [];
            $pais->alias('reside')->xownPersonaList = [];
            R::store($pais);
        }
        else {
           $e = ($nombre==null?new Exception("nulo"):new Exception("duplicado"));
           throw $e;
        }
    }
}
?>
