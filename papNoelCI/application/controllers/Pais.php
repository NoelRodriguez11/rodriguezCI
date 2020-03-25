<?php

class Pais extends CI_Controller
{

    public function dPost() {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $this->load->model('pais_model');
        $this->pais_model->borrarPais($id);
        redirect(base_url().'pais/r');
    }
    
    public function c()
    {
        frame($this,'pais/c');
    }

    public function cPost()
    {
        $this->load->model('pais_model');
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        try {
            $this->pais_model->crearPais($nombre);
            redirect(base_url() . 'pais/r');
        }
        catch (Exception $e) {
            session_start();
            $_SESSION['_msg']['texto']=$e->getMessage();
            $_SESSION['_msg']['uri']='pais/c';
            redirect(base_url() . 'msg');
        }
    }

    public function r()
    {
        $this->load->model('pais_model');
        $datos['paises'] = $this->pais_model->getPaises();
        frame($this,'pais/r', $datos);
    }
}
?>