<?php

class producto extends CI_Controller
{
    
    public function u() {
        
        if(!isRolOK("admin")){
            PRG("Rol inadecuado");
        }
        
        $id = isset($_GET['id'])?$_GET['id']:null;
        $this->load->model('producto_model');        
        $data['producto'] = $this->producto_model->getProductoById($id);        
        frame($this,'producto/u',$data);
        
    }
    
    public function uPost() {
        $this->load->model('producto_model');
        
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        
        try {
            $this->producto_model->actualizarProducto($id, $nombre);
            redirect(base_url() . 'producto/r');
        }
        catch (Exception $e) {
            session_start();
            $_SESSION['_msg']['texto']=$e->getMessage();
            $_SESSION['_msg']['uri']='producto/c';
            redirect(base_url() . 'msg');
        }
    }
    
    public function c() {
        
        if(!isRolOK("admin")){
            PRG("Rol inadecuado");
        }
        
        $this->load->model('categoria_model');
        $data['categorias'] = $this->categoria_model->getCategorias();
        frame($this,'producto/c',$data);
    }
    
    public function cPost() {
        
        if(!isRolOK("admin")){
            PRG("Rol inadecuado");
        }
        //MODELO
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $stock = isset($_POST['stock']) ? $_POST['stock'] : null;
        $precio = isset($_POST['precio']) ? $_POST['precio'] : null;
        $categoria= isset($_POST['categoria']) ? $_POST['categoria'] : null;
        
        try {
            $this->load->model('producto_model');
            $this->load->model('categoria_model');
            
            //TRATAMIENTO CATEGORIA
            if ($categoria == -1) {throw new Exception("Categoria no especificada");}
            
            try {
                $this->producto_model->crearProducto($nombre, $stock, $precio, $this->categoria_model->getCategoriaById($categoria));
                
            }
            catch (Exception $e) {
                
                throw new Exception ("Producto ya existente");
            }
            
            PRG('Producto creado correctamente','producto/r','success');
        }
        catch (Exception $e) {
            PRG($e->getMessage(), '/producto/c');
            
        }
    }
    
    public function r() {
        
        if(!isRolOK("admin")){
            PRG("Rol inadecuado");
        }
        
        $this->load->model('producto_model');
        $datos['productos'] = $this->producto_model->getProductos();
        frame($this,'producto/r', $datos);
    }
    
    public function dPost() {
        
        if(!isRolOK("admin")) {
            PRG("Rol inadeacuado");
        }
        
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $this->load->model('producto_model');
        $this->producto_model->borrarProducto($id);
        redirect(base_url().'producto/r');
    }
}
?>