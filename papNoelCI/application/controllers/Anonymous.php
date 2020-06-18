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
        $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : null;
        $foto = isset($_FILES['foto']) ? $_FILES['foto'] : null;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $altura = isset($_POST['altura']) ? $_POST['altura'] : null;
        $fnac = isset($_POST['fnac']) ? $_POST['fnac'] : null;
        $pais = isset($_POST['pais']) ? $_POST['pais'] : null;

        try {
            $ext_foto = null;
            if ($foto != null && $foto['error'] == UPLOAD_ERR_OK) {
                $name_and_ext = explode('.', $foto['name']);
                $ext_foto = $name_and_ext[sizeof($name_and_ext) - 1];
            }
            
            $this->load->model('persona_model');
            $this->load->model('pais_model');
           
            if ($pais == -1) {throw new Exception("País no especificado");
            }
            
            try {
            
                $id = $this->persona_model->registrarPersona($loginname, $pwd, $ext_foto, $nombre, $altura, $fnac, $this->pais_model->getPaisById($pais));
            }
            catch (Exception $e) {
                throw new Exception("Usuario ya existente");
            }
            
            if($ext_foto != null) {
                $file_name = 'persona' . '-'. $id . '.'. $ext_foto;
                $carpeta = "assets/img/upload/";
               
                copy($foto['tmp_name'], $carpeta . $file_name);
            }
     
            PRG('Usuario creado correctamente.', 'home', 'success');
            
        } 
        
        catch (Exception $e) {
            PRG($e->getMessage(), '');
        }
    }

    public function login() {
        frame($this, 'persona/login');
    }

    public function loginPost() {
        $loginname = isset($_POST['loginname']) ? $_POST['loginname'] : null;
        $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : null;
        $this->load->model('persona_model');
        try {
            $persona = $this->persona_model->verificarLogin($loginname, $pwd);
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
    
    //============================== AJAX =================================//
    
    private function toJSON($nombre) {
        $data =[];
        $this->load->model('producto_model');
        if($this->producto_model->productoRegistrado($nombre) != null) {
            $data["registrado"] = 1;
        }
        else {
            $data["registrado"] = 0;
        }
        return json_encode($data);
    }
    
    public function avisoAJAX() {
        $data['productoNombre'] = $_POST['productoNombre'];
        echo $this->toJSON($data['productoNombre']);
    }
}
?>