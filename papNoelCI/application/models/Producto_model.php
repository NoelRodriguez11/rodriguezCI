<?php

class Producto_model extends CI_Model
{
    public function borrarProducto($id) {
        R::trash(R::load('producto',$id));
    }
    
    public function getProductos()
    {
        return R::findAll('producto','ORDER BY nombre ASC');
    }
    
    public function crearProducto($nombre, $stock, $precio, $categoria) {
        
        $producto = R::findOne('producto','nombre=?',[$nombre]);
        $ok = ($producto==null && $nombre!=null);
        if ($ok) {
            $producto = R::dispense('producto');
            $producto->nombre = $nombre;
            $producto->stock = $nombre;
            $producto->precio = $precio;
            $producto->categoria = $categoria;
            R::store($producto);
        }
        else {
            $e = ($nombre==null?new Exception("nulo"):new Exception("Nombre de categorÃ­a ya registrado, escoge otro"));
            throw $e;
        }
        
    }
    
    public function getProductoById($id)
    {
        return R::load('producto', $id);
    }
    
    public function actualizarProducto($id, $nombre) {
        $producto = R::findOne('producto','nombre=?',[$nombre]);
        if ($nombre != null && $producto == null) {
            
            $producto = R::load('producto', $id);
            $producto->nombre = $nombre;
            R::store($producto);
            
        }
        else if ($nombre != null && $producto =! null) {}
        else {
            $e = ($nombre == null ? new Exception("nulo") : new Exception("Nombre de producto ya registrado, escoge otro"));
            throw $e;
        }
    }
}
?>