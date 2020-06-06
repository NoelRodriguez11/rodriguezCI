<div class="container">
	<h1>Nuevo Producto</h1>
	
	<form action="<?=base_url()?>producto/cPost" class="form" method="post" enctype="multipart/form-data">

		Nombre
		<input type="text" name="nombre" autofocus="autofocus"/>
		<br/>
		
		Stock
		<input type="number" name="stock"  value=10 required/>
		<br>
	
    	Precio
    	<input type="number" name="precio" min=0 max=1000 value=50 required/>
    	<br>
    		
		<script>
		$(window).on("load",(function() {
		$(function() {
		$('#id-foto').change(function(e) {addImage(e);});
		function addImage(e){
			var file = e.target.files[0],
			imageType = /image.*/;
			if (!file.type.match(imageType)) return;
			var reader = new FileReader();
			reader.onload = fileOnload;
			reader.readAsDataURL(file);
		}
		function fileOnload(e) {
		var result = e.target.result;
		$('#id-out-foto').attr("src", result);
		}});}));
    	</script>
    	
    	<label for="id-foto">Foto</label>
    	<input id="id-foto" type="file" name="foto"/>
    	<img class="offset-1 col-2" id="id-out-foto" width="3%" height="3%" src="" alt=""/>
    	<br/><br/>
    	
    	<label for="categoria">Categoría</label>
    	<select id="categoria" name="categoria">
    	<option selected = "selected">----</option>
    	<?php foreach ($categorias as $categoria):?>
    	<option value="<?=$categoria->id?>"><?=$categoria->nombre?></option>
    	<?php endforeach;?>
    	</select>
    	
    	<br/><br/>
		<input type="submit"/>
		<a href="<?=base_url()?>"><button class="button">Volver</button></a>		
	</form>
</div>