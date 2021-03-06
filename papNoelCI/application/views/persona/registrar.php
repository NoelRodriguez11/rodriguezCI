<div class="container">

<h1>Registro de nuevo usuario</h1>

<form action="<?=base_url()?>anonymous/registrarPost" method="post" enctype="multipart/form-data">

	<label for="id-login">Loginname</label>
	<input id="id-login" type="text" name="loginname" required="required"/>
	<br/>
	
	<label for="idp">Nombre</label>
	<input id="idp" type="text" name="nombre" required="required"/>
	<br/>
	
	<label for="id-pwd">Contraseña</label>
	<input id="id-pwd" type="password" name="pwd" required="required"/>
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
	
	<label for="id-alt">Altura (cm)</label>
	<input id="id-alt" type="number" name="altura" value=175 min=0 max=400 required="required"/>
	<br/>
	
	<label for="id-fnac">Fecha de Nacimiento</label>
	<input id="id-fnac" type="date" name="fnac" value="2000-02-29" required="required"/>
	<br/>
	
	<label for="id-pais">País de nacimiento</label>
	<select id="id-pais" name="pais">
	<option>----</option>
	<?php foreach ($paises as $pais):?>
	<option value="<?=$pais->id?>"><?=$pais->nombre?></option>
	<?php endforeach;?>
	</select>
	<br/><br/>

	<input type="submit"/>
</form>
<a href="<?=base_url()?>"><button class="button">Volver</button></a>

</div>
