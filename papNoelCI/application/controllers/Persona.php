<?php

class Persona extends CI_Controller
{

    public function u() {
        $id = isset($_GET['id'])?$_GET['id']:null;
        
        $this->load->model('persona_model');
        $this->load->model('pais_model');
        
        $data['persona'] = $this->persona_model->getPersonaById($id);
        $data['paises'] = $this->pais_model->getPaises();
        
        frame($this,'persona/u',$data);
        
    }
    
    public function uPost() {
        $this->load->model('persona_model');
        
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $idPaisNace = isset($_POST['idPaisNace']) ? $_POST['idPaisNace'] : null;
        $idPaisReside = isset($_POST['idPaisReside']) ? $_POST['idPaisReside'] : null;
        try {
            $this->persona_model->actualizarPersona($id, $nombre,$idPaisNace,$idPaisReside);
            redirect(base_url() . 'persona/r');
        }
        catch (Exception $e) {
            session_start();
            $_SESSION['_msg']['texto']=$e->getMessage();
            $_SESSION['_msg']['uri']='persona/c';
            redirect(base_url() . 'msg');
        }
    }
    
    public function c()
    {
        $this->load->model('pais_model');
        $data['paises'] = $this->pais_model->getPaises();
        //Esto es lo que muestra la vista del bean
        frame($this,'persona/c',$data);
    }

    public function cPost()
    {
        $this->load->model('persona_model');

        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : null;
        $idPaisNace = isset($_POST['idPaisNace']) ? $_POST['idPaisNace'] : null;
        $idPaisReside = isset($_POST['idPaisReside']) ? $_POST['idPaisReside'] : null;
        
        try {
            $this->persona_model->crearPersona($nombre,$pwd,$idPaisNace,$idPaisReside);
            redirect(base_url() . 'persona/r');
        }
        catch (Exception $e) {
            session_start();
            $_SESSION['_msg']['texto']=$e->getMessage();
            $_SESSION['_msg']['uri']='persona/c';
            redirect(base_url() . 'msg');
        }
    }

    public function r()
    {
        $this->load->model('persona_model');
        $datos['personas'] = $this->persona_model->getPersonas();
        frame($this,'persona/r', $datos);
    }
}
?>