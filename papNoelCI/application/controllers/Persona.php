<?php

class Persona extends CI_Controller
{

    public function u() {
        
        if(!isRolOK("admin")){
            PRG("Rol inadecuado");
        }
        
        $id = isset($_GET['id'])?$_GET['id']:null;
        
        $this->load->model('persona_model');
        $this->load->model('pais_model');
        
        $data['persona'] = $this->persona_model->getPersonaById($id);
        $data['paises'] = $this->pais_model->getPaises();
        
        frame($this,'persona/u',$data);
        
    }
    
    public function uPost() {
        
        if(!isRolOK("admin")){
            PRG("Rol inadecuado");
        }
        
        $this->load->model('persona_model');
        $this->load->model('pais_model');
        
        $id = isset($_POST['id']) ? $_POST['id']:null;
        $loginname = isset($_POST['loginname']) ? $_POST['loginname'] : null;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $altura = isset($_POST['altura']) ? $_POST['altura'] : null;
        $fnac = isset($_POST['fnac']) ? $_POST['fnac'] : null;
        $pais = isset($_POST['pais']) ? $_POST['pais'] : null;
        
        try {
            $this->persona_model->actualizarPersona($id, $loginname, $nombre, $altura, $fnac, $pais);
            redirect(base_url() . 'persona/r');
        }
        catch (Exception $e) {
            session_start();
            $_SESSION['_msg']['texto']=$e->getMessage();
            $_SESSION['_msg']['uri']='persona/c';
            redirect(base_url() . 'msg');
        }
    }

    public function r() {
        $this->load->model('persona_model');
        $datos['personas'] = $this->persona_model->getPersonas();
        frame($this,'persona/r', $datos);
    }
    
    public function dPost() {
        
        if(!isRolOK("admin")) {
            PRG("Rol inadeacuado");
        }
        
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $this->load->model('persona_model');
        $this->persona_model->borrarPersona($id);
        redirect(base_url().'persona/r');
    }
}
?>