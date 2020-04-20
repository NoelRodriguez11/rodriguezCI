<?php

class Anonymous extends CI_Controller {

    public function registrar() {
        $this->load->model('pais_model');
        $data['paises'] = $this->pais_model->getPaises();
        frame($this, 'persona/registrar', $data);
    }

    public function registrarPost() {
        $this->load->model('persona_model');
        
        $loginname = isset($_POST['loginname']) ? $_POST['loginname'] : null;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : null;
        $foto = isset($_POST['foto']) ? $_POST['foto'] : null;
        $altura = isset($_POST['altura']) ? $_POST['altura'] : null;
        $fnac = isset($_POST['fnac']) ? $_POST['fnac'] : null;
        $pais = isset($_POST['pais']) ? $_POST['pais'] : null;

        try {
            $this->persona_model->registrarPersona($loginname, $nombre, $pwd, $altura, $fnac, $pais);
//             $id = $this->persona_model->registrarPersona($loginname, $nombre, $pwd, $altura, $fnac, $pais);
            
//             if($foto !=null && $foto['tmp_name']!=null) {
//                 $extension = explode('.', $foto['name'])[1];
//                 $carpeta = "assets/img/upload";
//                 if(!copy($foto['tmp_name'], $carpeta . "persona-$id."  . $extension)) {
//                     throw new Exception('Error al copiar la foto '. $foto['name']. ' a '.$carpeta);
//                 }
//             }
            session_start();
            $_SESSION['_msg']['texto'] = "Usuario registrado con éxito";
            $_SESSION['_msg']['uri'] = '';
            redirect(base_url() . 'msg');
        } catch (Exception $e) {
            session_start();
            $_SESSION['_msg']['texto'] = $e->getMessage();
            $_SESSION['_msg']['uri'] = 'anonymous/registrar';
            redirect(base_url() . 'msg');
        }
    }

    public function login() {
        frame($this, 'persona/login');
    }

    public function loginPost() {
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : null;
        $this->load->model('persona_model');
        try {
            $persona = $this->persona_model->verificarLogin($nombre, $pwd);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['persona'] = $persona;
            redirect(base_url());
        } catch (Exception $e) {
            PRG($e->getMessage());
        }
    }
    
    public function logout() {
        if (session_status() == PHP_SESSION_NONE){
            session_start();
        }
        if (isset($_SESSION['persona'])) {
            unset ($_SESSION['persona']);
        }
        session_destroy();
        redirect(base_url());
    }
    
    public function init() {
        $data['vacia'] = true;
        $this->load->model('persona_model');
        
        if(sizeof(R::inspect()) != 0) {
            $data['vacia'] = false;
        }
        
        frame($this, '_hdu/anonymous/init', $data);
    }
    
    public function initPost() {
        $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : null;
        $data['msg'] = 'Password incorrecta';
        if($pwd == null || password_verify($pwd, password_hash("admin", PASSWORD_DEFAULT))) {
            R::nuke();
            $this->load->model('persona_model');
            $this->persona_model->crearPersona('admin','admin');
            
            $data['msg'] = "Base de Datos Creada";
        }
        frame($this, '_hdu/anonymous/initPost', $data);
    }
}
?>