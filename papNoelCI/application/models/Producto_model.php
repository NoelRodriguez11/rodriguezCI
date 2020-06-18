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
    
    public function productoRegistrado($nombre) {
        return R::findOne('producto', 'nombre=?', [$nombre]);
    }
    
    public function crearProducto($ext_foto, $nombre, $stock, $precio, $categoria) {
        
        $ok = ($nombre != null && $stock != null && $precio != null && $categoria != null && R::findOne('producto','nombre=?',[$nombre])==null);
        
        if ($ok) {
            $producto = R::dispense('producto');
            
            $categoriaPertenece = R::load('categoria',$categoria);
            
            $producto->ext_foto = $ext_foto;
            $producto->nombre = $nombre;
            $producto->stock = $stock;
            $producto->precio = $precio;
            $producto->categoria = $categoriaPertenece;
            R::store($producto);
        }
        else {
            $e = (R::findOne('producto','nombre=?',[$nombre])!=null? new Exception("Duplicado") : new Exception("valores nulos"));
            throw $e;
        }
        
    }
    
    public function getProductoById($id)
    {
        return R::load('producto', $id);
    }
    
    public function actualizarProducto($id, $nombre, $stock, $precio, $categoria) {
        
        $ok = ($nombre != null && $stock != null && $precio != null && $categoria != null);            
        if ($ok) {
            $producto = R::load('producto', $id);
            $producto->nombre = $nombre;
            $producto->stock = $stock;
            $producto->precio = $precio;
            $producto->categoria = $categoria;
            
            R::store($producto);
            
        }

        else {
            $e = ($nombre == null ? new Exception("nulo") : new Exception("Nombre de producto ya registrado, escoge otro"));
            throw $e;
        }
    }
}
?>