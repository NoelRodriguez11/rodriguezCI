<div class="container">
	<h1>Nuevo Producto</h1>
	
	<script type="text/javascript">
	function mostrar(respuestaAJAX) {
		if (json["registrado"] == 1) {
			var texto = "Producto Registrado";
			document.getElementById("alerta").style="display:inline";
			document.getElementById("productoNombre").classList.add("bg-warning");
    		document.getElementById("alerta").innerHTML=texto;
	}
		else {
			document.getElementById("alerta").innerHTML='';
			document.getElementById("productoNombre").classList.remove('bg-warning');
		}	
	}
	
	function lanzar() {
		url = "http://localhost/papCI-master/papNoelCI/producto/avisoAJAX"
		x = new XMLHttpRequest();
		x.open("POST", url, true);
		x.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		x.send(
				"productoNombre="+document.getElementById('productoNombre').value);
		x.onreadystatechange=function() {
			if (x.readyState==4 && x.status==200) {
				mostrar(x.responseText);
			}
			//--disable-web-security --disable-gpu --user-data-dir=C:\Windows\Temp
		}
		}
	}
	</script>
	
	<form action="<?=base_url()?>producto/cPost" class="form" method="post" enctype="multipart/form-data">

		Nombre
		<input type="text" name="nombre" id="productoNombre" onkeyup="lanzar()"/><div id="alerta" style="display:none;"></div>
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