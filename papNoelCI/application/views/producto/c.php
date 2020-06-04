<div class="container">
	<h1>Nuevo Producto</h1>
	<form action="<?=base_url()?>producto/cPost" method="post">
		Nombre
		<input type="text" name="nombre" autofocus="autofocus"/>
		<br/>
		
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
    	
    	<label for="id-pais">País de nacimiento</label>
    	<select id="id-pais" name="pais">
    	<option>----</option>
    	<?php foreach ($categorias as $categoria):?>
    	<option value="<?=$categoria->id?>"><?=$categoria->nombre?></option>
    	<?php endforeach;?>
    	</select>
    	<br/><br/>
		<input type="submit"/>
		<br/>
		
	</form>
</div>