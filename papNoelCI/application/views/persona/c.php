<div class="container">

<h1>Nueva persona</h1>

<form action="<?=base_url()?>persona/cPost" method="post">
	<label for="idp">Nombre</label>
	<input id="idp" type="text" name="nombre"/>
	<br/>
	
	<label for="id-pwd">Contraseña</label>
	<input id="id-pwd" type="password" name="pwd"/>
	<br/>

	País nacimiento
	<select name="idPaisNace">
		<?php foreach ($paises as $pais):?>
		<option value="<?=$pais->id?>"><?=$pais->nombre?></option>
		<?php endforeach;?>
	</select>
	<br/>
	<input type="submit"/>
</form>

</div>