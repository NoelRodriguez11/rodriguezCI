<?php
class Categoria extends CI_Controller {
        
    public function dPost() {
        
        if(!isRolOK("admin")){
            PRG("Rol inadecuado");
        }
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $this->load->model('categoria_model');
        $this->categoria_model->borrarCategoria($id);
        redirect(base_url().'categoria/r');
    }
    
    public function c() {
        if(!isRolOK("admin")){
            PRG("Rol inadecuado");
        }
        
        $this->load->model('producto_model');
        $data['productos'] = $this->producto_model->getProductos();
        frame($this,'categoria/c',$data);
    }
    
    public function cPost() {
        
        if(!isRolOK("admin")){
            PRG("Rol inadecuado");
        }
        
        $this->load->model('categoria_model');
        $nombre = $_POST['nombre'];
        try {
            $this->categoria_model->crearCategoria($nombre);
            PRG('Categoría creada','categoria/r','success');
        }
        catch (Exception $e) {
            PRG($e->getMessage(),'categoria/c','danger');
        }
     }
     
     public function r() {
         if(!isRolOK("admin")){
             PRG("Rol inadecuado");
         }
         $this->load->model('categoria_model');
         $data['categorias'] = $this->categoria_model->getCategorias();
         
         frame($this,'categoria/r',$data);
     }
     
     public function u()
     {
         if(!isRolOK("admin")){
             PRG("Rol inadecuado");
         }
         $id = isset($_GET['id']) ? $_GET['id'] : null;
         $this->load->model('categoria_model');
         $data['categoria'] = $this->categoria_model->getCategoriaById($id);
         frame($this, 'categoria/u', $data);    
     }
     
     public function uPost() {
         
         if(!isRolOK("admin")){
             PRG("Rol inadecuado");
         }
         $this->load->model('categoria_model');
         
         $id = isset($_POST['id']) ? $_POST['id'] : null;
         $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
         
         try {
             $this->categoria_model->actualizarCategoria($id, $nombre);
             redirect(base_url() . 'categoria/r');
         } catch (Exception $e) {
             session_start();
             $_SESSION['_msg']['texto'] = $e->getMessage();
             $_SESSION['_msg']['uri'] = 'categoria/r';
             redirect(base_url() . 'msg');
         }
     }
}
?>