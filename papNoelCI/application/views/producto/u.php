<div class="container">
	<h1>Editar producto</h1>

    <form action="<?=base_url()?>producto/uPost" method="post" enctype="multipart/form-data">
    	
    	<label for="idp">Nombre</label>
    	<input id="idp" type="text" name="nombre" value="<?=$producto->nombre?>"/>
    	<br/>
    	
    	<label for="idp">Stock</label>
    	<input id="idp" type="text" name="stock" value="<?=$producto->stock?>"/>
    	<br/>
    	
    	<label for="idp">Precio</label>
    	<input id="idp" type="text" name="precio" value="<?=$producto->precio?>"/>
    	<br/>
    	
    	<label for="idp">Categoria</label>
    	<select id="id-categoria" name="categoria">
		<?php foreach ($categorias as $categoria):?>
			<option value="<?=$categoria->id?>"><?= $categoria->nombre?></option>
		<?php endforeach;?>
	</select>
    	<br/>
    	
    	<input type="hidden" name="id" value="<?=$producto->id?>"/>
    	<input type="submit" value="Modificar"/>
	</form>
	<a href="<?=base_url()?>"><button class="button">Volver</button></a>
</div>