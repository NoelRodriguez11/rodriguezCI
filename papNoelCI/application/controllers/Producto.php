<?php

class producto extends CI_Controller
{
    
    public function u() {
        
        if(!isRolOK("admin")){
            PRG("Rol inadecuado");
        }
        
        $id = isset($_GET['id'])?$_GET['id']:null;
        
        $this->load->model('categoria_model');
        $this->load->model('producto_model');
        
        $data['producto'] = $this->producto_model->getProductoById($id); 
        $data['categorias'] = $this->categoria_model->getCategorias();
        
        frame($this,'producto/u',$data);
        
    }
    
    public function uPost() {
        
        if(!isRolOK("admin")){
            PRG("Rol inadecuado");
        }
        
        $this->load->model('producto_model');
        $this->load->model('categoria_model');
        
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $stock = isset($_POST['stock']) ? $_POST['stock'] : null;
        $precio = isset($_POST['precio']) ? $_POST['precio'] : null;
        $categoria = isset($_POST['categoria']) ? $_POST['categoria']: null;
        
        try {
            $this->producto_model->actualizarProducto($id, $nombre, $stock, $precio, $this->categoria_model->getCategoriaById($categoria));
            redirect(base_url() . 'producto/r');
        }
        catch (Exception $e) {
            session_start();
            $_SESSION['_msg']['texto']=$e->getMessage();
            $_SESSION['_msg']['uri']='producto/r';
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
        
        $foto = isset($_FILES['foto']) ? $_FILES['foto'] : null;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $stock = isset($_POST['stock']) ? $_POST['stock'] : null;
        $precio = isset($_POST['precio']) ? $_POST['precio'] : null;
        $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
        
        
        try {
            $ext_foto = null;
            if ($foto != null && $foto['error'] == UPLOAD_ERR_OK) {
                $name_and_ext = explode('.', $foto['name']);
                $ext_foto = $name_and_ext[sizeof($name_and_ext) - 1];
            }
        
            $this->load->model('producto_model');
            $this->load->model('categoria_model');
            
            if ($categoria == -1) {throw new Exception("Categoria no especificada");}
            
            try{
                $id = $this->producto_model->crearProducto($ext_foto, $nombre, $stock, $precio, $this->categoria_model->getCategoriaById($categoria));
            }
            catch (Exception $e){
                throw new Exception("Producto ya existente");
            }
                  
            if($ext_foto != null) {
                $path_img = 'assets/img/upload/';
                $file_name = 'producto-' . $id . '.' . $ext_foto;
                copy($foto['tmp_name'] , $path_img . $file_name);
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